@extends('layouts.app')

@section('content')
    <h1>name: {{$participant->name}}</h1>
    <h1>quiz score: {{$participant->score}}</h1>
    <hr>
    @foreach($questions as $question)
    <h3>Question {{$loop->iteration}}: {{$question->head}}</h3>

    @if($question->ansType == "TF")
        <div>the answer: {{DB::table('answers')->where('QID','=',$question->id)->value('answer')}}</div>
        <div>your answer: {{$answers[$loop->index]}}</div>
        
    @else
        
        
            <div>the answer: {{DB::table('answers')->where('QID','=',$question->id)->where('isCorrect',1)->value('answer')}}</div>
            <div>your answer: {{$answers[$loop->index]}}</div>
        
        
    @endif   
    <hr>
    @endforeach

@endsection