@extends('layouts.app')

@section('content')
    <h1>Create Quiz</h1>
    {!! Form::open(['action'=> ['App\Http\Controllers\QuestionBankController@importQuestion'], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('head', 'What is the question ?')}}
            {{Form::text('head', '', ['class' => 'form-control' , 'placeholder' => 'write your question here'])}}
        </div>
        <br>
        <div class="form-group">
            {{Form::label('score', "question's score")}}
            {{Form::number('score', '', ['class' => 'form-control ckeditor' , 'placeholder' => '25'])}}
            
        </div>
        <div class="form-group">
            <br>
            Select answer type:
        {{Form::select('ansType', array('MCQ' => 'multiple choice', 'TF' => 'True/False'),"MCQ", ['class' => 'form-control ckeditor'])}}
        <br>
        </div>
        <div class="form-group">
            {{__('text.select')}}
        {{Form::select('quiz', $quiz ," ", ['class' => 'form-control ckeditor'])}}
        <br> 
    
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}
@endsection