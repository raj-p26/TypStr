@extends('layouts.main')

@section('title', 'History')

@section('content')

@if (count($data) === 0)
<h1>No Records by You, Yet!</h1>
@else
<table class="table">
    <thead>
        <tr>
            <th>Record Using</th>
            <th>Accuracy &percnt;</th>
            <th>WPM</th>
            <th>Mistakes</th>
            <th>Completed &percnt;</th>
            <th>Number of Words</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $record)
        <tr>
            <td>{{ $record['record_type'] }}</td>
            <td>{{ $record['accuracy'] }}&percnt;</td>
            <td>{{ $record['wpm'] }}</td>
            <td>{{ $record['mistakes'] }}</td>
            <td>{{ $record['completed'] }}&percnt;</td>
            <td>{{ $record['num_of_words'] }}</td>
            <td>{{ date('Y-m-d', $record['inserted_at']) }}</td>
            <td>
                <form action="{{ url('/records/' . $record['id']) }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn text-danger bi bi-trash"></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection