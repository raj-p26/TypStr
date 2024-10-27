@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="d-flex align-items-center justify-content-between my-4">
    {{-- use `session('max_words') or 30` for laravel 5.4 --}}
    <input type="hidden" class="form-control w-50 mx-2" min="0" max="100" value="{{ session('max_words') ?? 30 }}" id="n-words" />
    <button id="get-words" class="btn btn-primary shadow">Random Words</button>
    <h1 id="timer-target" class="text-center">00:00</h1>
</div>

<h5 id="target-div" class="mb-4"></h5>
<h4 id="word-counter">0/0</h4>
<textarea id="key-input" class="form-control" style="font-size: 1.25rem !important;" spellcheck="false" autocomplete="off" rows="10"></textarea>
<div id="results">
</div>

@endsection