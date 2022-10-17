@extends('layouts.app')

@section('content')
    <a href="/questionBank" class="mb-3 btn btn-light btn-outline-secondary">Go Back</a>
    <h3>{{ $question->head }}</h3>
    <div>
        {{ __('text.question score') }}{!! $question->score !!}
    </div>
    <hr>
    <div>
        @if ($question->ansType == 'MCQ')
            <h3>{{ __('text.answers:') }}</h3>
            @foreach ($answers as $answer)
                {{ $loop->iteration }}- {{ $answer->answer }}
                @if ($answer->isCorrect == 1)
                    ({{ __('text.true') }})
                @else
                    ({{ __('text.false') }})
                @endif
                <br>
            @endforeach
        @else
            {{ __('text.answer:') }}
            @if (DB::table('answers')->where('QID', '=', $question->id)->get() == 'false')
                {{ __('text.false') }}
            @else
                {{ __('text.true') }}
            @endif
        @endif

    </div>
    <hr>
    <div>
        <a href="/questions/edit/{{ $question->id }}" class="btn btn-primary">{{ __('button.edit') }}</a><br><br>
        {!! Form::open(['action' => ['App\Http\Controllers\QuestionController@destroy' . $question->ansType, $question->id], 'method' => 'POST', 'class' => 'float-left']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit(__('button.delete'), ['class' => 'btn btn-danger']) }}
        {!! Form::close() !!}<br>
        <a href="/questions/importToBank/{{ $question->id }}" class="btn btn-info">{{ __('button.import') }}</a>
    </div>
@endsection
