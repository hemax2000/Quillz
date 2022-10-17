@extends('layouts.app')

@section('content')
    <a href="/questionBank" class="mb-3 btn btn-light btn-outline-secondary">Go Back</a>
    <h3>{{$question->head}}</h3> 
    <div>
        score: {!!$question->score!!}
    </div>
    <hr>
    <small>Written on: {{$question->created_at}}</small>
    <hr>
    <div>
        <h3>answer</h3>
        @foreach($answers as $answer)
        @if($question->ansType=='MCQ')
            
            {{$loop->iteration}}- {{$answer->answer}}
            @if($answer->isCorrect == 1)
            (Correct)
            @else
            (Flase)
            @endif
            <br>
        @else
        answer: {{$answer->answer}}
        @endif
        @endforeach
    </div>
    <hr>
    <a href="/questions/edit/{{$question->id}}" class="btn btn-primary">Edit</a></td>
    {!!Form::open(['action' => ['App\Http\Controllers\QuestionController@destroy'.$question->ansType, $question->id], 'method' => 'POST', 'class' => 'float-left'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
    
@endsection