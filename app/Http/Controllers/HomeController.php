<?php

namespace App\Http\Controllers;

use App\Models\Eatery;
use App\Models\District;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', ['eateryCount' => Eatery::count(), 'districtCount' => District::count(), 'reviewCount' => \App\Models\Review::count(), 'topEateries' => Eatery::with('district')->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating')->take(3)->get()]);
    }
}
