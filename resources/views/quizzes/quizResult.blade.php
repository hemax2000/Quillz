@extends('layouts.app')

@section('content')
    {{-- <h1>{{('text.name')}}{{ $quiz->head }}</h1>
    <h1>{{('text.total')}}{{ $totScore }}</h1>
    <hr>
    @if (count($participants) > 0)
    @foreach ($participants as $participant)
        <p>{{ $participant->name }} : {{ $participant->score }} / {{$totScore}}</p>
    @endforeach
    <hr>
    <a href="/quiz/resetResult/{{$quiz->id}}" class="btn btn-danger">{{('button.reset')}}</a>
    @else 
    <p>{{('text.no participant took the quiz yet')}}</p>
    @endif --}}

    <div class="card">
        <div class="card-header d-flex justify-content-center container">
            <h1 class=''>Result</h1>
        </div>
        <div class="card-body">

            @if (count($participants) > 0)
                <table class="table">



                    <thead>

                        <th scope="col">{{ $quiz->head }}</th>
                        <th scope="col">{{__("text.name")}}</th>
                        <th scope="col"></th>
                        <th scope="col">score</th>

                    </thead>
                    <tbody>
                        @foreach ($participants as $participant)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $participant->name }}</td>
                                <td></td>
                                <td>{{ $participant->score }}/{{ $totScore }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>{{ 'text.no participant took the quiz yet' }}</p>
            @endif
        </div>
    </div>
@endsection
