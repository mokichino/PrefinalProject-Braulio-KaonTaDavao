@if ($errors->any())
    <div class="mb-5 rounded-lg border border-[#c45b42] bg-[#fff0eb] p-4 text-sm text-[#8d3022]">
        <ul class="list-disc space-y-1 pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif
