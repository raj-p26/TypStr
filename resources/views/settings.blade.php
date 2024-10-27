@extends('layouts.main')

@section('title', 'Settings')

@section('content')

<form method="post" action="{{ url('/settings') }}" class="mt-4">
    {{-- if this doesn't work, use <input type="hidden" name="_method" value="put" /> --}}
    @method('put')
    @csrf
    <div class="row align-items-center">
        <div class="col-1">
            <label for="max-words" class="form-label">Words</label>
        </div>
        <div class="col-2">
            <input type="number" id="max-words" value="{{ session('max_words') ?? 30 }}" class="form-control" name="max_words" />
        </div>
    </div>
    <div class="row align-items-center my-3">
        <div class="col-1">
            <label for="theme" class="form-label">Theme</label>
        </div>
        <div class="col-2">
            <select name="theme" id="theme" class="form-control">
                <option value="dark" <?php if (session('theme') === 'dark') echo "selected"; ?>>Dark</option>
                <option value="light" <?php if (session('theme') === 'light') echo "selected"; ?>>Light</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <button class="btn btn-primary">Update Settings</button>
        </div>
    </div>
</form>

@endsection