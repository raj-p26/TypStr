@extends('layouts.main')

@section('title', 'Leaderboard')

@section('content')
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Username</th>
            <th>WPM</th>
            <th># of words</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
        <tr>
            <td>{{ $record->username }}</td>
            <td>{{ $record->wpm }}</td>
            <td>{{ $record->num_of_words }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection