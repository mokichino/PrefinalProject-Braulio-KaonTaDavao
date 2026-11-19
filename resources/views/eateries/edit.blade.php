@extends('layouts.app')
@section('title', 'Edit '.$eatery->name)
@section('content')<section class="mx-auto max-w-4xl px-5 py-12"><p class="text-sm font-bold uppercase tracking-widest text-[#b05b3b]">Keep it current</p><h1 class="mt-2 font-display text-4xl font-bold">Edit {{ $eatery->name }}</h1><form class="mt-8 border border-[#d9cdb8] bg-white p-6" method="POST" action="{{ route('eateries.update', $eatery) }}">@csrf @method('PUT') @include('eateries._form', ['buttonText' => 'Save changes'])</form></section>@endsection
