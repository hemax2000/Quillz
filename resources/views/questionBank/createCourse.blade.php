@extends('layouts.app')

@section('content')
    <h1>{{__('text.create course')}}</h1>
    {!! Form::open(['action'=> 'App\Http\Controllers\coursesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', __('text.course name'))}}
            {{Form::text('name', '', ['class' => 'form-control' , 'placeholder' => __('text.write course')])}}
        </div>
        <br>
        {{Form::submit(__('button.submit'), ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

    @endsection