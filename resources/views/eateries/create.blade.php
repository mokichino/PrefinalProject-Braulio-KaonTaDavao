@extends('layouts.app')
@section('title', 'Add an eatery - Kaon Ta! Davao')
@section('content')<section class="mx-auto max-w-4xl px-5 py-12"><p class="text-sm font-bold uppercase tracking-widest text-[#b05b3b]">Share a favorite</p><h1 class="mt-2 font-display text-4xl font-bold">Add an eatery</h1><form class="mt-8 border border-[#d9cdb8] bg-white p-6" method="POST" action="{{ route('eateries.store') }}">@csrf @include('eateries._form', ['buttonText' => 'Add eatery'])</form></section>@endsection
