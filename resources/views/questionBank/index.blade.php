@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="/home">{{__("text.dashboard")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="true" href="/questionBank">{{__("text.questionsBank")}}</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- <div class="row justify-content-between">
                        <div class="col-4">
                            <div class="d-flex flex-row flex-wrap">
                                <a href="/questionBank/createMCQ" class="btn btn-primary">{{__("button.addmcq")}}</a>
                                
                                <a href="/questionBank/createTF" class="btn btn-primary">{{__("button.addtf")}}</a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex flex-row-reverse flex-wrap">
                                <a href="/questionBank/createCourse" class="btn btn-primary">{{__("button.addcourse")}}</a>
                            </div>
                        </div>
                    </div> --}}

                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="d-flex flex-row flex-wrap col-4 dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{__("button.addQuestion")}}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="/questionBank/createMCQ">{{__("button.addmcq")}}</a></li>
                                    <li><a class="dropdown-item" href="/questionBank/createTF">{{__("button.addtf")}}</a></li>
                                </ul>
                            </div>
                            
                            <div class="d-flex flex-row-reverse flex-wrap col-4">
                                <a class="btn btn-primary" href="/course" class="btn btn-primary">{{__("button.categories")}}</a>
                            </div>
                        </div>
                    </div>

                    <hr>
                    {!!Form::open(['action' => 'App\Http\Controllers\QuestionBankController@filter', 'method' => 'POST', 'class' => 'float-left'])!!}
                        {{Form::label('course', __("text.course"))}}
                        {{Form::select('course',$coursesName ,$currentCourse, ['class' => 'form-select'])}}
                        <br>
                        {{Form::submit(__("button.filter"), ['class' => 'btn btn-primary'])}}
                    {!!Form::close()!!}
                    <hr>
                    <h3>{{__("text.question")}}</h3>
                    @if (count($questions) > 0)  
                    <table class="table table-light">
                        <thead>
                            <th scope="col">no course</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </thead>
                        @foreach ($questions as $question)
                            @if($question->CID == 0)
                            <tr>
                                <td>{{$question->head}}</td>
                                <td><a href="/questionBank/edit/{{$question->id}}" class="btn btn-primary">{{__("button.edit")}}</a></td>
                                <td>
                                    {!!Form::open(['action' => ['App\Http\Controllers\QuestionBankController@destroy'.$question->ansType, $question->id], 'method' => 'POST', 'class' => 'float-left'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit(__("button.delete"), ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                                <td><a href="/questionBank/import/{{$question->id}}" class="btn btn-secondary">{{__("button.import")}}</a></td>
                            </tr>        
                            @endif                    
                        @endforeach
                    </table> 
                        @foreach($courses as $course)                     
                        <table class="table table-light">
                            <thead table-light>
                                <th scope="col">{{$course->name}}</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </thead>
                            @foreach ($questions as $question)
                                @if($question->CID == $course->id)
                                <tr>
                                    <td>{{$question->head}}</td>
                                    <td><a href="/questionBank/edit/{{$question->id}}" class="btn btn-primary">{{__("button.edit")}}</a></td>
                                    <td>
                                        {!!Form::open(['action' => ['App\Http\Controllers\QuestionBankController@destroy'.$question->ansType, $question->id], 'method' => 'POST', 'class' => 'float-left'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit(__("button.delete"), ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                    <td><a href="/questionBank/import/{{$question->id}}" class="btn btn-secondary">{{__("button.import")}}</a></td>
                                </tr>        
                                @endif                    
                            @endforeach
                        </table>
                    @endforeach
                    @else
                        <p>You have no questions</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
