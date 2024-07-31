<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HandleVisitRequest;
use App\Models\Description;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
class VisitController extends Controller
{
    public function index()
    {
        // Check if the user is not an admin
        if (Auth::user()->isAdmin != 1) {
            // For non-admins: only fetch forms owned by the authenticated user
            $visits = Visit::with(['descriptions', 'ratings'])
                ->where('user_id', auth()->id())
                ->paginate(3);
        } else {
            // For admins: fetch all forms
            $visits = Visit::with(['descriptions', 'ratings'])
                ->paginate(3);
        }

        // Calculate the average rating for each form
        foreach ($visits as $visit) {
            $visit->average_rating = $visit->ratings->avg('rating');
        }

        return view('visits.index', compact('visits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visits.create');
    }

    /**
     * Store a new form created resource in storage.
     */

    public function store(HandleVisitRequest $request)
    {
        // Create the form
        $visit = Visit::create($request->validated());


        // Attach descriptions
        if ($request->has('descriptions')) {
            foreach ($request->input('descriptions') as $descriptionText) {
                if (trim($descriptionText)) { // Check if description is not empty
                    Description::create([
                        'description' => $descriptionText,
                        'describable_id' => $visit->id,
                        'describable_type' => Visit::class,
                    ]);
                }
            }
        }

        return redirect()->route('visits.index')->with('success', 'Form created successfully.');
    }
    public function storeFromVisitIndex(Request $request) : RedirectResponse
    {
        $validated = $request->validate([

            'side' => 'required|string|max:255',
            'descriptions' => 'array',
            'descriptions.*' => 'string|max:255'
        ]);

        // Create the form
        $visit = Visit::create([

            'side' => $validated['side'],
            'user_id' => Auth::id(),
        ]);

        // Attach descriptions
        if (isset($validated['descriptions'])) {
            foreach ($validated['descriptions'] as $descriptionText) {
                if (trim($descriptionText)) {
                    Description::create([
                        'description' => $descriptionText,
                        'describable_id' => $visit->id,
                        'describable_type' => Visit::class,
                    ]);
                }
            }
        }

        return redirect()->route('visits.index')->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $visit)
    {
        $user = auth()->user();

        // Fetch the user's rating for the form
        $userRating = $user ? $visit->ratings()->where('user_id', $user->id)->first()->rating ?? 0 : 0;

        // Pass the form and user's rating to the view
        return view('visits.show', compact('visit', 'userRating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $visit)
    {
        return view('visits.edit', compact('visit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HandleVisitRequest $request, Visit $visit)
    {
        // Update form fields
        $visit->update([

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
                    'describable_id' => $visit->id,
                    'describable_type' => Visit::class,
                ]);
                $newDescriptionIds[] = $description->id;
            }
        }

        // Delete descriptions that are no longer in the new list
        $visit->descriptions()
            ->whereNotIn('id', $newDescriptionIds)
            ->delete();

        return redirect()->route('visits.index')->with('success', 'Form updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        $visit->delete();
        return redirect()->route('visits.index')->with('success', 'Form deleted successfully.');
    }
}
