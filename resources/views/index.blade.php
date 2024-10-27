@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="d-flex align-items-center my-4">
    <label for="n-words" class="form-label">Number of words:</label>
    <input type="number" class="form-control w-50 mx-2" min="0" max="100" value="30" id="n-words" />
    <button id="get-words" class="btn btn-primary shadow">Generate Text</button>
</div>

<h1 id="timer-target" class="text-center">00:00</h1>
<h5 id="target-div" class="mb-4"></h5>
<textarea id="key-input" class="form-control" style="font-size: 1.25rem !important;" spellcheck="false" autocomplete="off" rows="10"></textarea>
<div>
    <span id="results"></span>
</div>
@endsection