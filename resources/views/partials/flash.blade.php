@if (session('success'))
    <div class="mx-auto mt-5 max-w-6xl px-5">
        <p class="rounded-lg border border-[#9bc6a3] bg-[#e6f4e8] px-4 py-3 text-sm font-semibold text-[#245b35]">{{ session('success') }}</p>
    </div>
@endif
