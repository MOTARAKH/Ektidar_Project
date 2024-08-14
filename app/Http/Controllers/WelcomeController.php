<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Form;
use App\Models\Media;
use App\Models\Post;
use App\Models\Reception;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $perPage = 3;

        // Paginate forms and order by average rating
        $forms = Form::select('forms.*')
            ->join('rates', 'rates.rateable_id', '=', 'forms.id')
            ->where('rates.rateable_type', Form::class)
            // ->groupBy('forms.id', 'forms.*', 'forms.created_at', 'forms.updated_at') // Include all selected columns
            // ->orderByRaw('AVG(rates.value) DESC')
            ->with(['descriptions', 'ratings'])
            ->paginate($perPage);
        // Calculate the average rating for each form
        foreach ($forms as $form) {
            $form->average_rating = $form->ratings->avg('rating');
        }

        // Paginate receptions and order by average rating
        $receptions = Reception::select('receptions.*')
            ->join('rates', 'rates.rateable_id', '=', 'receptions.id')
            ->where('rates.rateable_type', Reception::class)
            // ->groupBy('receptions.id', 'receptions.name', 'receptions.created_at', 'receptions.updated_at') // Include all selected columns
            // ->orderByRaw('AVG(rates.value) DESC')
            ->with(['descriptions', 'ratings'])
            ->paginate($perPage);

        // Calculate the average rating for each form
        foreach ($receptions as $reception) {
            $reception->average_rating = $reception->ratings->avg('rating');
        }

        // Paginate visits and order by average rating
        $visits = Visit::select('visits.*')
            ->join('rates', 'rates.rateable_id', '=', 'visits.id')
            ->where('rates.rateable_type', Visit::class)
            // ->groupBy('visits.id', 'visits.name', 'visits.created_at', 'visits.updated_at') // Include all selected columns
            // ->orderByRaw('AVG(rates.value) DESC')
            ->with(['descriptions', 'ratings'])
            ->paginate($perPage);

        // Calculate the average rating for each form
        foreach ($visits as $visit) {
            $visit->average_rating = $visit->ratings->avg('rating');
        }
        // Paginate posts and order by average rating
        $posts = Post::select('posts.*')
            ->join('rates', 'rates.rateable_id', '=', 'posts.id')
            ->where('rates.rateable_type', Post::class)
            // ->groupBy('posts.id', 'posts.name', 'posts.created_at', 'posts.updated_at') // Include all selected columns
            // ->orderByRaw('AVG(rates.value) DESC')
            ->with(['descriptions', 'ratings'])
            ->paginate($perPage);
        
        // for each posts
        // Calculate the average rating for each form
        foreach ($posts as $post) {
            $post->average_rating = $post->ratings->avg('rating');
        }

        // Paginate medias and order by average rating
        $medias = Media::select('medias.*')
            ->join('rates', 'rates.rateable_id', '=', 'medias.id')
            ->where('rates.rateable_type', Media::class)
            // ->groupBy('medias.id', 'medias.name', 'medias.created_at', 'medias.updated_at') // Include all selected columns
            // ->orderByRaw('AVG(rates.value) DESC')
            ->with(['descriptions', 'ratings'])
            ->paginate($perPage);


        // Calculate the average rating for each form
        foreach ($medias as $media) {
            $media->average_rating = $media->ratings->avg('rating');
        }

        // Paginate activities and order by average rating
        $activities = Activity::select('activities.*')
            ->join('rates', 'rates.rateable_id', '=', 'activities.id')
            ->where('rates.rateable_type', Activity::class)
            // ->groupBy('activities.id', 'activities.name', 'activities.created_at', 'activities.updated_at') // Include all selected columns
            // ->orderByRaw('AVG(rates.value) DESC')
            ->with(['descriptions', 'ratings'])
            ->paginate($perPage);
        // Calculate the average rating for each form
        foreach ($activities as $activity) {
            $activity->average_rating = $activity->ratings->avg('rating');
        }


        return view('welcome.welcome', compact('forms', 'receptions', 'visits', 'posts', 'medias', 'activities'));
    }
}
