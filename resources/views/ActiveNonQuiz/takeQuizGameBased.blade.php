@extends('layouts.app')

@section('content')
    <div id="Quiz-container" class="card hidden">
        <div class="card-header">
            <h3>{{ $quiz->head }}</h3>
        </div>
        {{-- <div class="d-flex progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
        </div> --}}
        <p id="timer" class="d-flex justify-content-center"></p>
        {!! Form::open(['action' => ['App\Http\Controllers\ActiveQuizController@calcScoreGameBased', $participant->id], 'method' => 'POST', 'id' => 'quizForm']) !!}
            <div class="card-body">
                @foreach ($questions as $question)
                    <div class="hidden" id="question{{ $loop->iteration }}">
                        <h5>Question {{ $loop->iteration }}: {{ $question->head }}</h5>

                        @if ($question->ansType == 'TF')
                            {{ Form::radio('answer' . $loop->iteration, 'true') }}
                            <label class="form-check-label">True</label>
                            <br>
                            {{ Form::radio('answer' . $loop->iteration, 'false') }}
                            <label class="form-check-label">False</label>
                        @else
                            @foreach (DB::table('answers')->where('QID', '=', $question->id)->get() as $answer)
                                {{ Form::radio('answer' . $loop->parent->iteration, $answer->id) }}{{ $answer->answer }}
                                <br>
                            @endforeach
                        @endif
                        <hr>
                    </div>
                @endforeach
                {{ Form::hidden('timeR', '', ['id' => 'TR']) }}
                <a class="btn btn-info" onclick="nextQuestion()" id='nextQuestion'>Next</a>
                {{ Form::submit('Submit', ['class' => 'btn btn-primary hidden', 'id' => 'sub', 'onclick' => 'getRemainingTime()']) }}
                {!! Form::close() !!}
            </div>

    </div>
    <div id="Quiz-container2" class="">
        <button class="btn btn-info" onclick="startQuiz({{ $quiz->duration }},{{ count($questions) }})">Start
            quiz</button>
    </div>
@endsection
