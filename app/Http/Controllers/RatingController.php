<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rateable_id' => 'required|integer',
            'rateable_type' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rate = Rate::updateOrCreate(
            [
                'rateable_id' => $request->rateable_id,
                'rateable_type' => $request->rateable_type,
                'user_id' => auth()->id(),
            ],
            ['rating' => $request->rating]
        );

        return response()->json(['success' => true]);
    }
}
