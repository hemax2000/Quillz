@extends('layouts.app')

@section('content')
    <a href="/quizzes" class="btn btn-default">Go Back</a>
    <h1>{{ $quiz->category }}</h1>
    <div>
        {!! $quiz->body !!}
    </div>
    <hr>
    <a href="/quizzes/{{ $quiz->id }}/edit" class="btn btn-default">Edit</a>

    {!! Form::open(['action' => ['App\Http\Controllers\QuizzesController@destroy', $quiz->id], 'method' => 'POST', 'class' => 'float-left']) !!}
    {{ Form::hidden('_method', 'DELETE') }}
    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}
@endsection
