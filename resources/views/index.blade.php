@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="form-control">
    <label for="n-words">Number of words:</label>
    <input type="number" min="0" max="100" id="n-words" />
</div>
<button id="get-words" class="btn btn-primary shadow">Generate Text</button>
<div id="target-div"></div>

<div class="mt-5">
    <button class="btn btn-primary" id="timer">Start Timer</button>
    <button class="btn btn-primary" id="reset-timer">Reset Timer</button>
    <button class="btn btn-primary" id="stop-timer">Stop Timer</button><br />
    <h1 id="timer-target"></h1>
</div>
@endsection