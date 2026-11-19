<nav class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4" aria-label="Main navigation">
    <a href="{{ route('home') }}" class="text-lg font-bold text-orange-700">Kaon Ta! Davao - Braulio's Food Guide</a>
    <div class="flex items-center gap-4 text-sm font-semibold">
        <a href="{{ route('eateries.index') }}" class="hover:text-orange-700">Eateries</a>
        <a href="{{ route('districts.index') }}" class="hover:text-orange-700">Districts</a>
        <a href="{{ route('eateries.create') }}" class="rounded bg-orange-700 px-3 py-2 text-white">Add an eatery</a>
    </div>
</nav>
