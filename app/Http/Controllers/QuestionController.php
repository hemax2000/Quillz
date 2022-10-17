<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\answers;
use App\Models\courses;


use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questions = DB::table('question')
            ->where('quiz_id', '=', $request->id)->get();
        $quiz = Quiz::find($request->id);

        return view('questions.customizePage')->with("questions", $questions)
            ->with("quiz", $quiz);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMCQ($id)
    {
        $quiz = Quiz::find($id);
        return view('questions.createMCQ')->with("quiz", $quiz);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMCQ(Request $request, $id){
        
        $this->validate($request, [
            'head' => 'required',
            'score' => 'required',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required'
        ]);

        $questionId = DB::table('question')
            ->insertGetId([
                'head' => $request->input('head'),
                'score' => $request->input('score'),
                'quiz_id' => $id,
                'ansType' => "MCQ"
            ]);


        for ($i = 1; $i < 5; $i++) {
            $answer = new answers;
            $answer->answer = $request->input('answer' . (string)$i);
            $answer->QID = $questionId;
            if ($request->input('correct') == $i)
                $answer->isCorrect = 1;
            else
                $answer->isCorrect = 0;

            $answer->save();
        }




        $questions = DB::table('question')
            ->where('quiz_id', '=', $id)->get();
        $quiz = Quiz::find($id);

        return view('questions.customizePage')->with("questions", $questions)
            ->with("quiz", $quiz);
    }
    public function createTF($id)
    {
        $quiz = Quiz::find($id);
        return view('questions.createTF')->with("quiz", $quiz);
    }

    public function storeTF(Request $request, $id){

        $this->validate($request, [
            'head' => 'required',
            'score' => 'required',
        ]);

        $questionId = DB::table('question')
            ->insertGetId([
                'head' => $request->input('head'),
                'score' => $request->input('score'),
                'quiz_id' => $id,
                'ansType' => "TF"
            ]);

        $fields = $request->input('answer');

        if ($fields == 'True') {

            $ansId = DB::table('answers')
                ->insertGetId(['answer' => 'true', 'QID' => $questionId, 'isCorrect' => 1]);
        } else {
            $ansId = DB::table('answers')
                ->insertGetId(['answer' => 'false', 'QID' => $questionId, 'isCorrect' => 0]);
        }

        $questions = DB::table('question')
            ->where('quiz_id', '=', $id)->get();
        $quiz = Quiz::find($id);

        return view('questions.customizePage')->with("questions", $questions)
            ->with("quiz", $quiz);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        $answers = DB::table('answers')
            ->where('QID', '=', $id)->get();
        return view('questions.showQuestion')->with('question', $question)
            ->with('answers', $answers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        $answers = DB::table('answers')
            ->where('QID', '=', $id)->get();
        $correct = 0;
        if ($question->ansType == 'MCQ') {
            for ($i = 0; $i < 4; $i++) {
                if ($answers[$i]->isCorrect == 1) {
                    $correct = $i + 1;
                }
            }
        }
        return view('questions.edit' . $question->ansType)->with('question', $question)->with('answers', $answers)->with('correct', $correct);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMCQ(Request $request, $id){

        $this->validate($request, [
            'head' => 'required',
            'score' => 'required',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required'
        ]);
        

        $question = Question::find($id);
        $question->head = $request->input('head');
        $question->score = $request->input('score');
        $question->save();

        $answers = DB::table('answers')
            ->where('QID', '=', $id)->pluck('id');

        for ($i = 0; $i < 4; $i++) {
            $answer = answers::find($answers[$i]);
            $answer->answer = $request->input('answer' . (string)($i + 1));
            $answer->QID = $id;
            if ($request->input('correct') == $i + 1)
                $answer->isCorrect = 1;
            else
                $answer->isCorrect = 0;

            $answer->save();
        }




        $questions = DB::table('question')
            ->where('quiz_id', '=', $question->quiz_id)->get();
        $quiz = Quiz::find($question->quiz_id);

        return view('questions.customizePage')->with("questions", $questions)
            ->with("quiz", $quiz);
    }

    public function updateTF(Request $request, $id){

        $this->validate($request, [
            'head' => 'required',
            'score' => 'required',
        ]);

        $question = Question::find($id);
        $question->head = $request->input('head');
        $question->score = $request->input('score');
        $question->save();

        $answers = DB::table('answers')
            ->where('QID', '=', $id)->pluck('id');


        $answer = answers::find($answers[0]);

        $fields = $request->input('answer');

        if ($fields == 'True') {

            $answer->answer = 'true';
            $answer->QID = $id;
            $answer->isCorrect = 1;
            $answer->save();
        } else {
            $answer->answer = 'false';
            $answer->QID = $id;
            $answer->isCorrect = 1;
            $answer->save();
        }

        $questions = DB::table('question')
            ->where('quiz_id', '=', $question->quiz_id)->get();
        $quiz = Quiz::find($question->quiz_id);


        return view('questions.customizePage')->with("questions", $questions)
            ->with("quiz", $quiz)->with('success', 'question Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMCQ($id)
    {
        $question = Question::find($id);
        $answers = DB::table('answers')
            ->where('QID', '=', $id)->pluck('id');
        for ($i = 0; $i < 4; $i++) {
            $answer = answers::find($answers[$i]);
            $answer->delete();
        }
        $question->delete();

        $questions = DB::table('question')
            ->where('quiz_id', '=', $question->quiz_id)->get();
        $quiz = Quiz::find($question->quiz_id);


        return view('questions.customizePage')->with("questions", $questions)
            ->with("quiz", $quiz)->with('success', 'question Deleted');
    }

    public function destroyTF($id)
    {
        $question = Question::find($id);
        $answers = DB::table('answers')
            ->where('QID', '=', $id)->pluck('id');

        $answer = answers::find($answers[0]);
        $answer->delete();
        $question->delete();

        $questions = DB::table('question')
            ->where('quiz_id', '=', $question->quiz_id)->get();
        $quiz = Quiz::find($question->quiz_id);


        return view('questions.customizePage')->with("questions", $questions)
            ->with("quiz", $quiz)->with('success', 'question Updated');
    }
    public function importToBank($id)
    {
        $question = Question::find($id);
        $answers = DB::table('answers')
            ->where('QID', '=', $id)->get();
        $correct = 0;
        if ($question->ansType == 'MCQ') {
            for ($i = 0; $i < 4; $i++) {
                if ($answers[$i]->isCorrect == 1) {
                    $correct = $i + 1;
                }
            }
        }
        $user_id = auth()->user()->id;

        $coursesName = DB::table('courses')
            ->where('user_id', '=', $user_id)
            ->pluck('name', 'name');
            $courses = array_merge(['Without course' => 'Without Course'], $coursesName->all());

        $currentCourse = courses::find($question->id);
        return view('questions.importToBank' . $question->ansType)->with('question', $question)->with('answers', $answers)->with('correct', $correct)->with('coursesName', $courses)
            ->with('currentCourse', $currentCourse);
    }
}
