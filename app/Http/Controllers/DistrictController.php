<?php

namespace App\Http\Controllers;

use App\Models\District;

class DistrictController extends Controller
{
    public function index()
    {
        return view('districts.index', ['districts' => District::withCount('eateries')->orderBy('name')->get()]);
    }

    public function show(District $district)
    {
        return view('districts.show', ['district' => $district->load(['eateries' => fn ($query) => $query->withAvg('reviews', 'rating')->with('features')])]);
    }
}
