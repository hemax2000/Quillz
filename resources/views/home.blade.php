@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="/home">{{__("text.dashboard")}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/questionBank">{{__("text.questionsBank")}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        @php
                            $countDis=0;
                            $countClose=0;
                        @endphp
                        

                        {{-- <a href="/quizzes/create" class="btn btn-primary">{{__("button.create quiz")}}</a> --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            {{__("button.create quiz")}}
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Quiz type</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mx-auto">
                                        <a href="/quizzes/create?type=gb" class="btn btn-success btn-lg">{{__("button.game based")}}</a>
                                        <a href="/quizzes/create?type=nongb" class="btn btn-primary btn-lg">{{__("button.formal")}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        {!! Form::open(['action' => 'App\Http\Controllers\HomeController@filter', 'method' => 'POST', 'class' => 'float-left']) !!}
                        {{ Form::label('course', __("text.course")) }}
                        {{ Form::select('course', $coursesName, 'null', ['class' => 'form-select']) }}
                        <br>
                        {{ Form::submit(__("button.filter"), ['class' => 'btn btn-primary']) }}
                        {!! Form::close() !!}
                        <hr>

                        <h3>{{__("text.quiz")}}</h3>
                        @if (count($quizzes) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>{{__("text.noCourses")}}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($quizzes as $quiz)
                                    @if ($quiz->CID == 0)
                                        <tr>
                                            <td>{{ $quiz->head }}</td>
                                            @if ($quiz->code == null)
                                                <td>
                                                    <a href="/questions?id={{ $quiz->id }}" class="btn btn-primary">{{__("button.edit")}}</a>
                                                </td>
                                                <td>
                                                    {!! Form::open(['action' => ['App\Http\Controllers\QuizzesController@destroy', $quiz->id], 'method' => 'POST', 'class' => 'float-left']) !!}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {{ Form::submit(__("button.delete"), ['class' => 'btn btn-danger']) }}
                                                    {!! Form::close() !!}
                                                </td>
                                                <td>
                                                    
                                                    <button class="btn btn-success"
                                                        onclick="disModal({{ $countDis++ }})">{{__("button.activate")}}</button>

                                                    {!! Form::open(['action' => ['App\Http\Controllers\QuizzesController@saveCode', $quiz->id], 'method' => 'POST', 'class' => 'codeModal']) !!}
                                                    <div class="modal-content">
                                                        <span class="close"
                                                            onclick="closeModal({{ $countClose++ }})">&times;</span>

                                                        {{ Form::label('code', 'Enter the Quizzes code here (without spaces): ', ['class' => 'mb-3']) }}
                                                        {{ Form::text('code', '', ['class' => 'form-control mb-3', 'placeholder' => 'ex. SWE497']) }}
                                                        <br>
                                                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                                                        {!! Form::close() !!}
                                                        
                                                </td>
                                            @else
                                                <td> Quiz code: {{ $quiz->code }}</td>
                                                <td><a href="/quiz/deactivate/{{ $quiz->id }}"
                                                        class="btn btn-primary">{{__("button.deactivate")}}</a></td>
                                            @endif
                                            <td><a href="/quiz/result/{{ $quiz->id }}"
                                                    class="btn btn-warning">{{__("button.result")}}</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                            @foreach ($courses as $course)
                                <table class="table table-striped">
                                    <tr>
                                        <th>{{ $course->name }}</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>

                                    </tr>
                                    @foreach ($quizzes as $quiz)
                                        @if ($quiz->CID == $course->id)
                                            <tr>
                                                <td>{{ $quiz->head }}</td>
                                                @if ($quiz->code == null)
                                                
                                                    <td><a href="/questions?id={{ $quiz->id }}"
                                                            class="btn btn-primary">{{__("button.edit")}}</a></td>
                                                    <td>
                                                        {!! Form::open(['action' => ['App\Http\Controllers\QuizzesController@destroy', $quiz->id], 'method' => 'POST', 'class' => 'float-left']) !!}
                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                        {{ Form::submit(__("button.delete"), ['class' => 'btn btn-danger']) }}
                                                        {!! Form::close() !!}
                                                    </td>
                                                    <td>

                                                        <button class="btn btn-success"
                                                            onclick="disModal({{$countDis++  }})">{{__("button.activate")}}</button>

                                                        {!! Form::open(['action' => ['App\Http\Controllers\QuizzesController@saveCode', $quiz->id], 'method' => 'POST', 'class' => 'modal']) !!}
                                                        <div class="modal-content">
                                                            <span class="close"
                                                                onclick="closeModal({{$countClose++  }})">&times;</span>

                                                            {{ Form::label('code', __("text.enter code")) }}
                                                            {{ Form::text('code', '', ['class' => 'form-control', 'placeholder' => 'ex. SWE497']) }}
                                                            <br>
                                                            {{ Form::submit(__('button.submit'), ['class' => 'btn btn-primary']) }}
                                                            {!! Form::close() !!}
                                                    </td>
                                                @else
                                                    <td> Quiz code: {{ $quiz->code }}</td>
                                                    <td><a href="/questions?id={{ $quiz->id }}"
                                                            class="btn btn-primary">{{__("button.deactivate")}}</a></td>
                                                @endif
                                                <td><a href="/quiz/result/{{ $quiz->id }}"
                                                        class="btn btn-warning">{{__("button.result")}}</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            @endforeach
                        @else
                            <p>{{__('text.no quiz')}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
