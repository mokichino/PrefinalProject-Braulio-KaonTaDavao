<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEateryRequest;
use App\Http\Requests\UpdateEateryRequest;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use Illuminate\Support\Str;

class EateryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Eatery::with(['district', 'features', 'permit'])->withAvg('reviews', 'rating')->orderBy('name');
        $query->when(request('q'), fn ($builder, $search) => $builder->where(fn ($inner) => $inner->where('name', 'like', "%{$search}%")->orWhere('specialty', 'like', "%{$search}%")));
        $query->when(request('district'), fn ($builder, $district) => $builder->where('district_id', $district));
        $query->when(request('feature'), fn ($builder, $feature) => $builder->whereHas('features', fn ($features) => $features->whereKey($feature)));
        return view('eateries.index', ['eateries' => $query->paginate(6)->withQueryString(), 'districts' => District::orderBy('name')->get(), 'features' => Feature::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eateries.create', ['districts' => District::orderBy('name')->get(), 'features' => Feature::orderBy('name')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEateryRequest $request)
    {
        $data = $request->validated();
        $features = $data['features'] ?? [];
        unset($data['features'], $data['permit_no'], $data['expires_on']);
        $eatery = Eatery::create($data + ['slug' => Str::slug($data['name']), 'is_open' => $request->boolean('is_open')]);
        $eatery->permit()->create($request->safe()->only(['permit_no', 'expires_on']));
        $eatery->features()->sync($features);
        return redirect()->route('eateries.show', $eatery)->with('success', 'Eatery added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Eatery $eatery)
    {
        $eatery->load(['district', 'permit', 'dishes', 'features', 'reviews.user']);
        return view('eateries.show', compact('eatery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eatery $eatery)
    {
        $eatery->load('permit', 'features');
        return view('eateries.edit', ['eatery' => $eatery, 'districts' => District::orderBy('name')->get(), 'features' => Feature::orderBy('name')->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEateryRequest $request, Eatery $eatery)
    {
        $data = $request->validated();
        $features = $data['features'] ?? [];
        unset($data['features'], $data['permit_no'], $data['expires_on']);
        $eatery->update($data + ['slug' => Str::slug($data['name']), 'is_open' => $request->boolean('is_open')]);
        $eatery->permit()->updateOrCreate([], $request->safe()->only(['permit_no', 'expires_on']));
        $eatery->features()->sync($features);
        return redirect()->route('eateries.show', $eatery)->with('success', 'Eatery updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eatery $eatery)
    {
        $eatery->features()->detach();
        $eatery->permit()->delete();
        $eatery->dishes()->delete();
        $eatery->reviews()->delete();
        $eatery->delete();
        return redirect()->route('eateries.index')->with('success', 'Eatery deleted.');
    }
}
