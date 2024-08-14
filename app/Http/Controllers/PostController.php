<?php

namespace App\Http\Controllers;

use App\Http\Requests\HandlePostRequest;
use App\Models\Post;
use App\Models\Description;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Check if the user is not an admin
         if (Auth::user()->isAdmin != 1) {
            // For non-admins: only fetch forms owned by the authenticated user
            $posts = Post::with(['descriptions', 'ratings'])
                ->where('user_id', Auth::user()->id)
                ->paginate(3);
        } else {
            // posts admins: fetch all forms
            $posts = Form::with(['descriptions', 'ratings'])
                ->paginate(3);
        }

        // Calculate the average rating for each form
        foreach ($posts as $form) {
            $form->average_rating = $form->ratings->avg('rating');
        }

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HandlePostRequest $request)
    {
        // Create the form
        $form = Post::create($request->validated());


        // Attach descriptions
        if ($request->has('descriptions')) {
            foreach ($request->input('descriptions') as $descriptionText) {
                if (trim($descriptionText)) { // Check if description is not empty
                    Description::create([
                        'description' => $descriptionText,
                        'describable_id' => $form->id,
                        'describable_type' => Post::class,
                    ]);
                }
            }
        }

        return redirect()->route('posts.index')->with('success', 'Form created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $media = Post::findOrFail($id);
        $user = auth()->user();

        // Fetch the user's rating for the form
        $userRating = $user ? $media->ratings()->where('user_id', $user->id)->first()->rating ?? 0 : 0;

        // Pass the form and user's rating to the view
        return view('posts.show', compact('media', 'userRating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HandlePostRequest $request, $id)
    {

        $form = Post::findOrFail($id);
        // Update form fields
        $form->update([
            'title' => $request->input('title'),
            'side' => $request->input('side'),
            'sidesParticipating' => $request->input('sidesParticipating'),
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
                    'describable_type' => Post::class,
                ]);
                $newDescriptionIds[] = $description->id;
            }
        }

        // Delete descriptions that are no longer in the new list
        $form->descriptions()
            ->whereNotIn('id', $newDescriptionIds)
            ->delete();

        return redirect()->route('posts.index')->with('success', 'Form updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Form deleted successfully.');
    }
}
