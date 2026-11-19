<div class="flex items-center gap-2 text-sm" aria-label="{{ number_format((float) ($rating ?? 0), 1) }} out of 5 stars">
    <span class="text-[#d97706]">{{ str_repeat('★', (int) round($rating ?? 0)) }}{{ str_repeat('☆', 5 - (int) round($rating ?? 0)) }}</span>
    <span class="text-[#68736d]">{{ number_format((float) ($rating ?? 0), 1) }}</span>
</div>
