<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Eatery;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Eatery $eatery)
    {
        $eatery->reviews()->create($request->validated() + ['user_id' => auth()->id() ?? \App\Models\User::first()->id]);
        return back()->with('success', 'Salamat! Review posted.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted.');
    }
}
