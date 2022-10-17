@extends('layouts.app')

@section('content')
    <h1>quizzes</h1>
    @if (count($quizzes) > 0)
        @foreach($quizzes as $quiz)
            <div class="well">
                <h3><a href="/quizzes/{{$quiz->id}}">{{$quiz->category}}</a></h3>
                <small>Written on {{$quiz->created_at}}</small>
            </div>
        @endforeach
        {{$quizzes->links()}}
    @else
        <p>{{__"text.noQuizzes"}}No quizzes found</p>
    @endif
@endsection