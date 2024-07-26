<?php

namespace App\Http\Controllers;


use App\Http\Requests\HandleMediaRequest;
use App\Models\Description;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MediaController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->isAdmin != 1) {
            $media = Media::with('descriptions')->where('user_id', auth()->id())->paginate(3);
        } else {
            $media = Media::with('descriptions')->paginate(3);
        }
        return view('media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('media.create');
    }

    /**
     * Store a new form created resource in storage.
     */

    public function store(HandleMediaRequest $request)
    {
        // Create the form
        $media = Media::create($request->validated());


        // Attach descriptions
        if ($request->has('descriptions')) {
            foreach ($request->input('descriptions') as $descriptionText) {
                if (trim($descriptionText)) { // Check if description is not empty
                    Description::create([
                        'description' => $descriptionText,
                        'describable_id' => $media->id,
                        'describable_type' => Media::class,
                    ]);
                }
            }
        }

        return redirect()->route('media.index')->with('success', 'Form created successfully.');
    }
    public function storeFromMediaIndex(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'MediaOutlet' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'ParticipatingParties' => 'required|string|max:255',
            'descriptions' => 'array',
            'descriptions.*' => 'string|max:255'
        ]);

        // Create the form
        $media = Media::create([
            'type' => $validated['type'],
            'MediaOutlet' => $validated['MediaOutlet'],
            'topic' => $validated['topic'],
            'ParticipatingParties' => $validated['ParticipatingParties'],
            'user_id' => Auth::id(),
        ]);

        // Attach descriptions
        if (isset($validated['descriptions'])) {
            foreach ($validated['descriptions'] as $descriptionText) {
                if (trim($descriptionText)) {
                    Description::create([
                        'description' => $descriptionText,
                        'describable_id' => $media->id,
                        'describable_type' => Media::class,
                    ]);
                }
            }
        }

        return redirect()->route('media.index')->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        return view('media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        return view('media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HandleMediaRequest $request, Media $media)
    {
        // Update form fields
        $media->update([
            'type' => $request->input('type'),
            'MediaOutlet' => $request->input('MediaOutlet'),
            'topic' => $request->input('topic'),
            'ParticipatingParties' => $request->input('ParticipatingParties'),
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
                    'describable_id' => $media->id,
                    'describable_type' => Media::class,
                ]);
                $newDescriptionIds[] = $description->id;
            }
        }

        // Delete descriptions that are no longer in the new list
        $media->descriptions()
            ->whereNotIn('id', $newDescriptionIds)
            ->delete();

        return redirect()->route('media.index')->with('success', 'Form updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        $media->delete();
        return redirect()->route('media.index')->with('success', 'Form deleted successfully.');
    }
}
