@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('text.courses') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="row justify-content-between">

                <div class="d-flex flex-row-reverse flex-wrap">
                    <a href="/questionBank/createCourse" class="btn btn-primary">{{__("button.addcourse")}}</a>
                </div>
            
            <h3>{{__("text.your courses")}}</h3>
            <hr>
            @if (count($courses)>0)
                
            
                <table class="table table-light">
                    <thead>
                        <th scope="col">{{__("text.name")}}</th>
                        <th scope="col"></th>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                        <td scope="row">{{$course->name}}</td>
                        <td>{!!Form::open(['action' => ['App\Http\Controllers\coursesController@destroy', $course->id], 'method' => 'POST', 'class' => 'float-left'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit(__("button.delete"), ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                        </td>
                        @endforeach
                    </tbody>
                    @else
                    <h3>no courses was found</h3>
                    @endif 
            </div>   
        </div>
    </div>
@endsection