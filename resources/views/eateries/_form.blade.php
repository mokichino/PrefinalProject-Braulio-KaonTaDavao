@include('partials.errors')
<div class="grid gap-5 md:grid-cols-2">
    <label class="field">Name<input name="name" value="{{ old('name', $eatery->name ?? '') }}" required></label>
    <label class="field">District<select name="district_id" required><option value="">Choose a district</option>@foreach ($districts as $district)<option value="{{ $district->id }}" @selected(old('district_id', $eatery->district_id ?? '') == $district->id)>{{ $district->name }}</option>@endforeach</select></label>
    <label class="field">Address<input name="address" value="{{ old('address', $eatery->address ?? '') }}" required></label>
    <label class="field">Price range<input name="price_range" value="{{ old('price_range', $eatery->price_range ?? '') }}" placeholder="budget, mid, or splurge" required></label>
    <label class="field">Specialty<input name="specialty" value="{{ old('specialty', $eatery->specialty ?? '') }}"></label>
    <label class="field">Permit number<input name="permit_no" value="{{ old('permit_no', $eatery->permit->permit_no ?? '') }}" required></label>
    <label class="field">Permit expiry<input type="date" name="expires_on" value="{{ old('expires_on', optional($eatery->permit ?? null)->expires_on?->format('Y-m-d')) }}" required></label>
</div>

<div class="mt-6 grid gap-4">
    <fieldset class="rounded-xl border border-[#d9cdb8] bg-white/70 p-4 sm:p-5">
        <legend class="px-2 text-sm font-bold">Status</legend>
        <label class="grid grid-cols-[18px_minmax(0,1fr)] items-center gap-3 text-sm font-semibold">
            <input type="checkbox" name="is_open" value="1" class="h-4 w-4" @checked(old('is_open', $eatery->is_open ?? true))>
            <span>Currently open</span>
        </label>
    </fieldset>

    <fieldset class="rounded-xl border border-[#d9cdb8] bg-white/70 p-4 sm:p-5">
        <legend class="px-2 text-sm font-bold">Features</legend>
        <div class="grid grid-cols-1 gap-x-4 gap-y-2 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($features as $feature)
                <label class="grid grid-cols-[18px_minmax(0,1fr)] items-start gap-3 rounded-lg px-1 py-1 text-sm leading-5 hover:bg-white">
                    <input type="checkbox" name="features[]" value="{{ $feature->id }}" class="mt-0.5 h-4 w-4" @checked(in_array($feature->id, old('features', isset($eatery) ? $eatery->features->pluck('id')->all() : [])))>
                    <span>{{ $feature->name }}</span>
                </label>
            @endforeach
        </div>
    </fieldset>
</div>

<button class="mt-7 w-full rounded-full bg-[#b05b3b] px-5 py-3 font-bold text-white hover:bg-[#8d422d] sm:w-auto">{{ $buttonText }}</button>
