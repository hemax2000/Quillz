@extends('layouts.app')

@section('content')
    <h1>Start Quiz</h1>
    {!! Form::open(['action'=> ['App\Http\Controllers\ActiveQuizController@storeName', $quiz], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Participant name: ')}}
            {{Form::text('name', '', ['class' => 'form-control' , 'placeholder' => 'Enter participant name here'])}}
        </div>
        <br>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    
    @endsection