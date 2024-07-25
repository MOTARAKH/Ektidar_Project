<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;
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


});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard-admin', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('dashboard-admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
