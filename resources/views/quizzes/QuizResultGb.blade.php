@extends('layouts.app')

@section('content')
    <h1>{{__('text.name')}}{{ $quiz->head }}</h1>
    <h1>{{__('text.total')}}{{ $totScore }}</h1>
    <hr>
    @if(count($participants)>0)
    @foreach ($participants as $participant)
        <p>{{ $participant->name }} : {{ $participant->score }}</p>
    @endforeach
    <hr>
    <a href="" class="btn btn-danger">{{__('button.reset')}}</a>
    @else 
    <p>{{__('text.no participant took the quiz yet')}}</p>
    @endif
@endsection