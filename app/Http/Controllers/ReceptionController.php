<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HandleFormRequest;
use App\Http\Requests\HandleRecepetionRequest;
use App\Models\Description;
use App\Models\Form;
use App\Models\Reception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
class ReceptionController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin != 1) {
            $receptions = Reception::with('descriptions')->where('user_id', auth()->id())->paginate(3);
        } else {
            $receptions = Reception::with('descriptions')->paginate(3);
        }
        return view('receptions.index', compact('receptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('receptions.create');
    }

    /**
     * Store a new form created resource in storage.
     */

    public function store(HandleRecepetionRequest $request)
    {
        // Create the form
        $reception = Reception::create($request->validated());


        // Attach descriptions
        if ($request->has('descriptions')) {
            foreach ($request->input('descriptions') as $descriptionText) {
                if (trim($descriptionText)) { // Check if description is not empty
                    Description::create([
                        'description' => $descriptionText,
                        'describable_id' => $reception->id,
                        'describable_type' => Reception::class,
                    ]);
                }
            }
        }

        return redirect()->route('receptions.index')->with('success', 'Form created successfully.');
    }
    public function storeFromIndex(Request $request) : RedirectResponse
    {
        $validated = $request->validate([

            'side' => 'required|string|max:255',
            'descriptions' => 'array',
            'descriptions.*' => 'string|max:255'
        ]);

        // Create the form
        $receptions = Reception::create([

            'side' => $validated['side'],
            'user_id' => Auth::id(),
        ]);

        // Attach descriptions
        if (isset($validated['descriptions'])) {
            foreach ($validated['descriptions'] as $descriptionText) {
                if (trim($descriptionText)) {
                    Description::create([
                        'description' => $descriptionText,
                        'describable_id' => $receptions->id,
                        'describable_type' => Reception::class,
                    ]);
                }
            }
        }

        return redirect()->route('receptions.index')->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reception $reception)
    {
        return view('receptions.show', compact('reception'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reception $reception)
    {
        return view('receptions.edit', compact('reception'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HandleRecepetionRequest $request, Reception $reception)
    {
        // Update form fields
        $reception->update([
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
                    'describable_id' => $reception->id,
                    'describable_type' => Reception::class,
                ]);
                $newDescriptionIds[] = $description->id;
            }
        }

        // Delete descriptions that are no longer in the new list
        $reception->descriptions()
            ->whereNotIn('id', $newDescriptionIds)
            ->delete();

        return redirect()->route('receptions.index')->with('success', 'Form updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reception $reception)
    {
        $reception->delete();
        return redirect()->route('receptions.index')->with('success', 'Form deleted successfully.');
    }

}
