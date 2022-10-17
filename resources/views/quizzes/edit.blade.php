@extends('layouts.app')

@section('content')
    <h1 class="mb-3">{{__('text.edit quiz')}}</h1>
    {!! Form::open(['action'=> ['App\Http\Controllers\QuizzesController@update',$quiz->id], 'method' => 'POST']) !!}
        <div class="mb-3">
            {{Form::label('head', __('text.quiz name'))}}
            {{Form::text('head', $quiz->head, ['class' => 'form-control' , 'placeholder' => 'Quiz 2'])}}
        </div>
        <div class="mb-3">
            {{Form::label('course', __('text.quiz course'))}}
            {{Form::select('course', $courses,"", ['class' => 'form-control ckeditor'])}}
        </div>
        
        <div class="mb-3">
            {{Form::label('duration', __('text.quiz duration'))}}
            {{Form::number('duration', $quiz->duration, ['class' => 'form-control ckeditor' , 'min' => '1'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit(__('button.submit'), ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection