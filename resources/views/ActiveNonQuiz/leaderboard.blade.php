@extends('layouts.app')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            {{-- <th scope="col">Accuracy</th> --}}
            {{-- <th scope="col">Speed</th> --}}
            <th scope="col">Score</th>
        </tr>
    </thead>
    <tbody>
        @foreach($participants as $participant)
        {{-- @if ($quiz->id == $participant->quiz_id) --}}
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$participant->name}}</td>
                {{-- <td>{{$participants->accuracy}}</td> --}}
                {{-- <td>{{$participants->speed}}</td> --}}
                <td>{{$participant->score}}</td>
            </tr>
        {{-- @else --}}
            {{-- <p class="mb-3">No particiants sumbit quiz</p> --}}
        {{-- @endif --}}
        @endforeach
    </tbody>
    </table>
@endsection