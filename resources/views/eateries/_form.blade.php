@include('partials.errors')
<div class="grid gap-5 md:grid-cols-2">
    <label class="field">Name<input name="name" value="{{ old('name', $eatery->name ?? '') }}" required></label>
    <label class="field">District<select name="district_id" required><option value="">Choose a district</option>@foreach ($districts as $district)<option value="{{ $district->id }}" @selected(old('district_id', $eatery->district_id ?? '') == $district->id)>{{ $district->name }}</option>@endforeach</select></label>
    <label class="field">Address<input name="address" value="{{ old('address', $eatery->address ?? '') }}" required></label>
    <label class="field">Price range<input name="price_range" value="{{ old('price_range', $eatery->price_range ?? '') }}" placeholder="₱ to ₱₱₱" required></label>
    <label class="field">Specialty<input name="specialty" value="{{ old('specialty', $eatery->specialty ?? '') }}"></label>
    <label class="field">Permit number<input name="permit_no" value="{{ old('permit_no', $eatery->permit->permit_no ?? '') }}" required></label>
    <label class="field">Permit expiry<input type="date" name="expires_on" value="{{ old('expires_on', optional($eatery->permit ?? null)->expires_on?->format('Y-m-d')) }}" required></label>
</div>
<label class="mt-5 flex items-center gap-3 text-sm font-semibold"><input type="checkbox" name="is_open" value="1" @checked(old('is_open', $eatery->is_open ?? true))> Currently open</label>
<fieldset class="mt-5"><legend class="mb-3 text-sm font-bold">Features</legend><div class="grid gap-3 sm:grid-cols-2 md:grid-cols-3">@foreach ($features as $feature)<label class="flex items-center gap-2 text-sm"><input type="checkbox" name="features[]" value="{{ $feature->id }}" @checked(in_array($feature->id, old('features', isset($eatery) ? $eatery->features->pluck('id')->all() : [])))>{{ $feature->name }}</label>@endforeach</div></fieldset>
<button class="mt-7 rounded-full bg-[#b05b3b] px-5 py-3 font-bold text-white hover:bg-[#8d422d]">{{ $buttonText }}</button>
