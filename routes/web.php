<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
// Guest
Route::get('/', [WelcomeController::class,'welcome'])->name('welcome');
// Logged in

Route::middleware('auth')->group(function () {
    /** choose a month */
    Route::post('/storeMonth', function (Illuminate\Http\Request $request) {
        $selectedMonth = $request->input('month');
        session(['selected_month' => $selectedMonth]);
        return redirect()->back()->with('success', 'Month selected successfully : '.$selectedMonth);
    });
    /** forms routes */
    Route::resource('forms', FormController::class);
    Route::post('/storeFromIndex', [FormController::class, 'storeFromIndex'])->name('forms.storeFromIndex');
    /** receptions routes */
    Route::resource('receptions', ReceptionController::class);
    Route::post('/storeFromReceptionIndex', [ReceptionController::class, 'storeFromReceptionIndex'])->name('receptions.storeFromReceptionIndex');
    /** visits routes */
    Route::resource('visits', VisitController::class);
    Route::post('/storeFromVisitIndex', [VisitController::class, 'storeFromVisitIndex'])->name('visits.storeFromVisitIndex');
    /** medias routes */
    Route::resource('media', MediaController::class);
    Route::post('/storeFromMediaIndex', [MediaController::class, 'storeFromMediaIndex'])->name('media.storeFromMediaIndex');
    /** activities routes */
    Route::resource('activities', ActivityController::class);
    Route::post('/storeFromActivityIndex', [ActivityController::class, 'storeFromActivityIndex'])->name('activity.storeFromActivityIndex');
    /** posts routes */
    Route::resource('posts', PostController::class);
    Route::post('/storeFromPostIndex', [PostController::class, 'storeFromPostIndex'])->name('post.storeFromPostIndex');
    // rating-route // 
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
