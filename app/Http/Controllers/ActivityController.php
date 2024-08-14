<?php

namespace App\Http\Controllers;

use App\Http\Requests\HandleActivityRequest;
use App\Models\Activity;
use App\Models\Description;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user is not an admin
        if (Auth::user()->isAdmin != 1) {
            // For non-admins: only fetch activities owned by the authenticated user
            $activities = Activity::with(['descriptions', 'ratings'])
                ->where('user_id', auth()->id())
                ->paginate(3);
        } else {
            // For admins: fetch all activities
            $activities = Activity::with(['descriptions', 'ratings'])
                ->paginate(3);
        }

        // Calculate the average rating for each form
        foreach ($activities as $form) {
            $form->average_rating = $form->ratings->avg('rating');
        }

        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HandleActivityRequest $request)
    {
        // dd($request->all());
        // Create the form
        $activity = Activity::create($request->validated());


        // Attach descriptions
        if ($request->has('descriptions')) {
            foreach ($request->input('descriptions') as $descriptionText) {
                if (trim($descriptionText)) { // Check if description is not empty
                    Description::create([
                        'description' => $descriptionText,
                        'describable_id' => $activity->id,
                        'describable_type' => Activity::class,
                    ]);
                }
            }
        }

        return redirect()->route('activities.index')->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activity= Activity::findOrFail($id);
        // Assuming you have a way to get the authenticated user
        $user = auth()->user();

        // Fetch the user's rating for the form
        $userRating = $user ? $activity->ratings()->where('user_id', $user->id)->first()->rating ?? 0 : 0;

        // Pass the form and user's rating to the view
        return view('activities.show', compact('activity', 'userRating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($id);
        $activity = Activity::findOrFail($id);
        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HandleActivityRequest $request, $id)
    {
        // dd($request->all());
        $form = Activity::findOrFail($id);
        // Update form fields
        $form->update([
            'address' => $request->input('address'),
            'side' => $request->input('side'),
            'finished' => $request->input('finished') ? 1 : 0
        ]);
        // Get current descriptions from the request
        $newDescriptions = $request->input('descriptions', []);

        // Create a set of new description IDs for reference
        $newDescriptionIds = [];

        foreach ($newDescriptions as $descriptionText) {
            if (trim($descriptionText)) { // Check if description is not empty
                $description = Description::firstOrCreate([
                    'description' => $descriptionText,
                    'describable_id' => $form->id,
                    'describable_type' => Activity::class,
                ]);
                $newDescriptionIds[] = $description->id;
            }
        }

        // Delete descriptions that are no longer in the new list
        $form->descriptions()
            ->whereNotIn('id', $newDescriptionIds)
            ->delete();

        return redirect()->route('activities.index')->with('success', 'Form updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Activity::findOrFail($id);
        $post->delete();
        return redirect()->route('activities.index')->with('success', 'Form deleted successfully.');
    }
}
