@extends('layouts.app')

@section('content')
    <div class="card-body">
        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
        @endif

        <h1 class="mb-3">{{__('text.customize your quiz')}}</h1>  
            
            {{-- <div class="container mb-3">
                <div class="d-flex justify-content-center">
                    <div class="col-4">
                    <a class="btn btn-primary" href="/questions/createMCQ/{{$quiz->id}}">{{__("button.addmcq")}}</a>
                    </div>
                    <div class="col-4">
                    <a class="btn btn-primary" href="/questions/createTF/{{$quiz->id}}">{{__("button.addtf")}}</a>
                    </div>
                    <div class="col-4">
                        <a class="btn btn-primary" href="/quizzes/{{$quiz->id}}/edit" class="btn btn-primary">{{__("button.setting")}}</a>
                    </div>
                </div>
            </div> --}}

            <div class="container mb-3">
                <div class="d-flex justify-content-center">
                    <div class="col">
                    <a class="btn btn-secondary" href="/questions/createMCQ/{{$quiz->id}}">{{__("button.addmcq")}}</a>
                    </div>
                    <div class="col">
                    <a class="btn btn-secondary" href="/questions/createTF/{{$quiz->id}}">{{__("button.addtf")}}</a>
                    </div>
                    <div class="col">
                        <a class="btn btn-secondary" href="/quizzes/{{$quiz->id}}/edit" class="btn btn-primary">{{__("button.setting")}}</a>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary" href="/home" class="btn btn-primary">{{__("button.submit")}}</a>
                    </div>
                </div>
            </div>

            

        <br>
            <h3>{{__('text.question')}}</h3>
            
            @if (count($questions) > 0)
            @foreach($questions as $question)
                <div class="card card-body mb-3">
                    <h3><a href="/question/show/{{$question->id}}">{{$question->head}}</a></h3>
                </div>
            @endforeach
            
        @else
            <p>{{__('text.no question')}}</p>
        @endif
    </div>
@endsection