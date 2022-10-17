@extends('layouts.app')

@section('content')
    <h1>{{ __('text.create question') }}</h1>
    {!! Form::open(['action' => ['App\Http\Controllers\QuestionBankController@updateTF', $question->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{ Form::label('head', __('text.question name')) }}
        {{ Form::text('head', $question->head, ['class' => 'form-control', 'placeholder' => __('text.write question')]) }}
    </div>
    <br>
    <div class="form-group">
        {{ Form::label('score', __('text.question score')) }}
        {{ Form::number('score', $question->score, ['class' => 'form-control ckeditor', 'placeholder' => '25']) }}

    </div>
    <br>
    <div class="form-group">
        {{ Form::label('course', __('text.quiz course')) }}
        {{ Form::select('course', $coursesName, 'null', ['class' => 'form-control ckeditor']) }}
    </div>
    <div class="form-group">
        <br>
        <hr>
        <h1>{{ __('text.is it') }}</h1>
        {{ Form::radio('answer', 'True', $answers[0]->answer == 'true') }} {{ __('text.true') }}
        <br>
        {{ Form::radio('answer', 'False', $answers[0]->answer == 'false') }} {{ __('text.false') }}

        <br>
        <br>
        {{ Form::submit(__('button.submit'), ['class' => 'btn btn-primary']) }}
    </div>
    {!! Form::close() !!}
@endsection
