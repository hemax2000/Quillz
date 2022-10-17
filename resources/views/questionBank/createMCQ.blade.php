@extends('layouts.app')

@section('content')
    <h1>{{__('text.create question')}}</h1>
    {!! Form::open(['action'=> ['App\Http\Controllers\QuestionBankController@storeMCQ'], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('head', __('text.question name'))}}
            {{Form::text('head', '', ['class' => 'form-control' , 'placeholder' => __('text.write question')])}}
        </div>
        <br>
        <div class="form-group">
            {{Form::label('score', __('text.question score'))}}
            {{Form::number('score', '', ['class' => 'form-control ckeditor' , 'placeholder' => '25'])}}
            
        </div>
        <br>
        <div class="form-group">
            {{Form::label('course', __('text.quiz course'))}}
            {{Form::select('course', $courses,"null", ['class' => 'form-control ckeditor'])}}
        </div>
        <div class="form-group">

        <br>
        <hr>
        <h1>{{__('text.create answer')}}</h1>
        <div class="form-group">
            {{Form::label('answer1', __('text.answer 1'))}}
            {{Form::text('answer1', '', ['class' => 'form-control' , 'placeholder' =>  __('text.write answer')])}}
        </div>
        <br>
        <div class="form-group">
            {{Form::label('answer2', __('text.answer 2'))}}
            {{Form::text('answer2', '', ['class' => 'form-control' , 'placeholder' =>  __('text.write answer')])}}
        </div>
        <br>
        <div class="form-group">
            {{Form::label('answer3', __('text.answer 3'))}}
            {{Form::text('answer3', '', ['class' => 'form-control' , 'placeholder' =>  __('text.write answer')])}}
        </div>
        <br>
        <div class="form-group">
            {{Form::label('answer4', __('text.answer 4'))}}
            {{Form::text('answer4', '', ['class' => 'form-control' , 'placeholder' =>  __('text.write answer')])}}
        </div>
        <br>
        <div class="form-group">
            {{__('text.correct answer')}} 
        {{Form::select('correct', array( 1 => __('text.answer 1'), 2 => __('text.answer 2'), 3 => __('text.answer 3'), 4 => __('text.answer 4')),__('text.answer 1'), ['class' => 'form-select'])}}
        </div>
        <br>

        {{Form::submit(__('button.submit'), ['class'=>'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}
@endsection