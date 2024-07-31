<?php

namespace App\Http\Controllers;

use App\Http\Requests\HandleFormRequest;
use App\Models\Description;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user is not an admin
        if (Auth::user()->isAdmin != 1) {
            // For non-admins: only fetch forms owned by the authenticated user
            $forms = Form::with(['descriptions', 'ratings'])
                ->where('user_id', auth()->id())
                ->paginate(3);
        } else {
            // For admins: fetch all forms
            $forms = Form::with(['descriptions', 'ratings'])
                ->paginate(3);
        }

        // Calculate the average rating for each form
        foreach ($forms as $form) {
            $form->average_rating = $form->ratings->avg('rating');
        }

        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a new form created resource in storage.
     */

    public function store(HandleFormRequest $request)
    {
        // Create the form
        $form = Form::create($request->validated());


        // Attach descriptions
        if ($request->has('descriptions')) {
            foreach ($request->input('descriptions') as $descriptionText) {
                if (trim($descriptionText)) { // Check if description is not empty
                    Description::create([
                        'description' => $descriptionText,
                        'describable_id' => $form->id,
                        'describable_type' => Form::class,
                    ]);
                }
            }
        }

        return redirect()->route('forms.index')->with('success', 'Form created successfully.');
    }
    public function storeFromIndex(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'side' => 'required|string|max:255',
            'descriptions' => 'array',
            'descriptions.*' => 'string|max:255'
        ]);

        // Create the form
        $form = Form::create([
            'title' => $validated['title'],
            'side' => $validated['side'],
            'user_id' => Auth::id(),
        ]);

        // Attach descriptions
        if (isset($validated['descriptions'])) {
            foreach ($validated['descriptions'] as $descriptionText) {
                if (trim($descriptionText)) {
                    Description::create([
                        'description' => $descriptionText,
                        'describable_id' => $form->id,
                        'describable_type' => Form::class,
                    ]);
                }
            }
        }

        return redirect()->route('forms.index')->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        // Assuming you have a way to get the authenticated user
        $user = auth()->user();

        // Fetch the user's rating for the form
        $userRating = $user ? $form->ratings()->where('user_id', $user->id)->first()->rating ?? 0 : 0;

        // Pass the form and user's rating to the view
        return view('forms.show', compact('form', 'userRating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        return view('forms.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HandleFormRequest $request, Form $form)
    {
        // Update form fields
        $form->update([
            'title' => $request->input('title'),
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
                    'describable_type' => Form::class,
                ]);
                $newDescriptionIds[] = $description->id;
            }
        }

        // Delete descriptions that are no longer in the new list
        $form->descriptions()
            ->whereNotIn('id', $newDescriptionIds)
            ->delete();

        return redirect()->route('forms.index')->with('success', 'Form updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('forms.index')->with('success', 'Form deleted successfully.');
    }
}
