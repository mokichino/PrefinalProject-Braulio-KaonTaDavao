<article class="flex h-full flex-col border border-[#d9cdb8] bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
    <div class="mb-4 flex items-start justify-between gap-3">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-[#b05b3b]">
                <a href="{{ route('districts.show', $eatery->district) }}" class="hover:underline">{{ $eatery->district->name }}</a>
            </p>
            <h2 class="mt-1 font-display text-xl font-bold"><a href="{{ route('eateries.show', $eatery) }}" class="hover:text-[#b05b3b]">{{ $eatery->name }}</a></h2>
        </div>
        <span class="rounded-full px-3 py-1 text-xs font-bold {{ $eatery->is_open ? 'bg-[#e6f4e8] text-[#245b35]' : 'bg-[#fbe7df] text-[#9b3d2b]' }}">{{ $eatery->is_open ? 'Open' : 'Closed' }}</span>
    </div>
    <p class="mb-3 text-sm text-[#68736d]">{{ $eatery->specialty }} · {{ $eatery->price_range }}</p>
    @include('components.rating', ['rating' => $eatery->reviews_avg_rating ?? 0])
    <div class="mt-auto flex flex-wrap gap-2 pt-5">
        @foreach ($eatery->features as $feature)
            <a href="{{ route('eateries.index', ['feature' => $feature->id]) }}" class="rounded-full bg-[#f7ead5] px-3 py-1 text-xs">{{ $feature->name }}</a>
        @endforeach
    </div>
</article>
