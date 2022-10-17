@extends('layouts.app')

@section('content')
    <h1>{{__('text.create quiz')}}</h1>
    {!! Form::open(['action'=> 'App\Http\Controllers\QuizzesController@store', 'method' => 'POST']) !!}
        
        <div class="mb-3">
            {{Form::label('head', __('text.quiz name'))}}
            {{Form::text('head', '', ['class' => 'form-control' , 'placeholder' => 'e.g, Quiz 2'])}}
        </div>


        {{Form::hidden('type', $type)}}


        {{-- <select class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select> --}}

        {{-- <div class="mb-3">
            {{Form::label('quiz_type', __('text.quiz type'))}}
            {{Form::select('quiz_type', $quizType,'', ['class' => 'form-control'])}}
        </div> --}}

        <div class="mb-3">
            {{Form::label('course', __('text.quiz course'))}}
            {{Form::select('course', $coursesName,"", ['class' => 'form-control'])}}
        </div>
        
        <div class="mb-3">
            {{Form::label('duration', __('text.quiz duration'))}}
            {{Form::number('duration', '', ['class' => 'form-control ckeditor' , 'min' => '1'])}}
        </div>
        {{Form::submit(__('button.submit'), ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection