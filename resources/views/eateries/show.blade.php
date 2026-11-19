@extends('layouts.app')
@section('title', $eatery->name.' - Kaon Ta! Davao')
@section('content')
<section class="mx-auto max-w-6xl px-5 py-12">
    <div class="flex flex-wrap items-start justify-between gap-5">
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-[#b05b3b]">{{ $eatery->district->name }} · {{ $eatery->price_range }}</p>
            <h1 class="mt-2 font-display text-5xl font-bold">{{ $eatery->name }}</h1>
            <p class="mt-4 text-lg text-[#68736d]">{{ $eatery->address }} · {{ $eatery->specialty }}</p>
        </div>
        <div class="flex gap-2">
            <a class="rounded-full border border-[#173b35] px-4 py-2 text-sm font-bold" href="{{ route('eateries.edit', $eatery) }}">Edit</a>
            <form method="POST" action="{{ route('eateries.destroy', $eatery) }}">
                @csrf
                @method('DELETE')
                <button class="rounded-full bg-[#9b3d2b] px-4 py-2 text-sm font-bold text-white">Delete</button>
            </form>
        </div>
    </div>

    <div class="mt-7 flex flex-wrap gap-2">
        <span class="rounded-full px-3 py-1 text-sm font-bold {{ $eatery->is_open ? 'bg-[#e6f4e8] text-[#245b35]' : 'bg-[#fbe7df] text-[#9b3d2b]' }}">{{ $eatery->is_open ? 'Open now' : 'Closed' }}</span>
        @foreach ($eatery->features as $feature)
            <a href="{{ route('eateries.index', ['feature' => $feature->id]) }}" class="rounded-full bg-[#f7ead5] px-3 py-1 text-sm">{{ $feature->name }}</a>
        @endforeach
    </div>

    <div class="mt-12 grid gap-10 lg:grid-cols-[1.1fr_.9fr]">
        <div>
            <h2 class="font-display text-3xl font-bold">Menu</h2>
            <div class="mt-5 divide-y divide-[#d9cdb8] border-y border-[#d9cdb8]">
                @foreach ($eatery->dishes as $dish)
                    <div class="flex items-center justify-between gap-4 py-4">
                        <div>
                            <h3 class="font-bold">{{ $dish->name }}</h3>
                            @if ($dish->is_bestseller)<span class="text-xs font-bold uppercase tracking-wider text-[#b05b3b]">Bestseller</span>@endif
                        </div>
                        <span class="font-bold">₱{{ number_format($dish->price, 2) }}</span>
                    </div>
                @endforeach
            </div>

            <h2 class="mt-12 font-display text-3xl font-bold">Reviews</h2>
            <div class="mt-5 space-y-5">
                @forelse ($eatery->reviews as $review)
                    <article class="border-b border-[#d9cdb8] pb-5">
                        <div class="flex justify-between gap-3">
                            <div>
                                <a class="font-bold text-[#b05b3b]" href="{{ route('reviewers.show', $review->user) }}">{{ $review->user->name }}</a>
                                <div class="mt-1">@include('components.rating', ['rating' => $review->rating])</div>
                            </div>
                            <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs font-bold text-[#9b3d2b]">Delete</button>
                            </form>
                        </div>
                        <p class="mt-3 text-[#68736d]">{{ $review->body }}</p>
                    </article>
                @empty
                    <p class="text-[#68736d]">No reviews yet.</p>
                @endforelse
            </div>
        </div>

        <aside class="space-y-6">
            @if ($eatery->permit)
                <div class="rounded-xl border border-[#d9cdb8] bg-white p-5">
                    <h2 class="font-display text-xl font-bold">Permit</h2>
                    <p class="mt-2"><strong>Permit number:</strong> {{ $eatery->permit->permit_no }}</p>
                    <p class="mt-1"><strong>Expiry:</strong>
                        <span class="{{ $eatery->permit->expires_on->isBefore(today()) ? 'font-bold text-red-700' : '' }}">
                            {{ $eatery->permit->expires_on->format('F j, Y') }}
                            @if ($eatery->permit->expires_on->isBefore(today())) — Permit expired @endif
                        </span>
                    </p>
                </div>
            @endif

            @if ($eatery->is_open)
                <form class="rounded-xl border border-[#d9cdb8] bg-white p-5" method="POST" action="{{ route('eateries.reviews.store', $eatery) }}">
                    @csrf
                    <h2 class="font-display text-xl font-bold">Write a review</h2>
                    <label class="field mt-4">Reviewer
                        <select name="user_id" required>
                            <option value="">Choose a reviewer</option>
                            @foreach (\App\Models\User::orderBy('name')->get() as $reviewer)
                                <option value="{{ $reviewer->id }}" @selected(old('user_id') == $reviewer->id)>{{ $reviewer->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')<span class="text-sm text-red-700">{{ $message }}</span>@enderror
                    </label>
                    <label class="field mt-4">Rating
                        <select name="rating" required>
                            <option value="">Choose a rating</option>
                            @for ($rating = 1; $rating <= 5; $rating++)
                                <option value="{{ $rating }}" @selected(old('rating') == $rating)>{{ $rating }} star{{ $rating === 1 ? '' : 's' }}</option>
                            @endfor
                        </select>
                        @error('rating')<span class="text-sm text-red-700">{{ $message }}</span>@enderror
                    </label>
                    <label class="field mt-4">Your review
                        <textarea name="body" rows="5" minlength="10" maxlength="1000" required>{{ old('body') }}</textarea>
                        @error('body')<span class="text-sm text-red-700">{{ $message }}</span>@enderror
                    </label>
                    <button class="mt-4 rounded-full bg-[#b05b3b] px-5 py-2 font-bold text-white">Post review</button>
                </form>
            @else
                <p class="rounded-xl border border-[#d9cdb8] bg-white p-5 font-bold">This eatery is closed. Reviews are paused.</p>
            @endif
        </aside>
    </div>
</section>
@endsection
