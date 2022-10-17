<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courses;
use App\Models\answers;
use App\Models\AnswersBank;
use App\Models\questionBank;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionBankController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $courses = courses::orderBy('created_at', 'desc')->paginate(10)->where('user_id', '=', $user_id);
        $coursesName = DB::table('courses')
            ->where('user_id', '=', $user_id)
            ->pluck('name', 'name');
        $questions = questionBank::orderBy('created_at', 'desc')->paginate(10)->where('user_id', '=', $user_id);

        $coursesName = array_merge(['all' => 'All courses'], $coursesName->all());
        $currentCourse = '';

        return view('questionBank.index')->with('questions', $questions)
            ->with('courses', $courses)
            ->with('coursesName', $coursesName)
            ->with('currentCourse', $currentCourse);
    }


    public function createMCQ()
    {
        $user_id = auth()->user()->id;
        $courses = DB::table('courses')
            ->where('user_id', '=', $user_id)
            ->pluck('name', 'name');
            $coursesName = array_merge(['Without course' => 'Without Course'], $courses->all());
        return view('questionBank.createMCQ')->with('courses', $coursesName);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMCQ(Request $request){

        $this->validate($request, [
            'head' => 'required',
            'score' => 'required',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required'
        ]);

        $user_id = auth()->user()->id;
        if($request->input('course') == 'Without course'){
            $questionId = DB::table('questionBank')
            ->insertGetId([
                'head' => $request->input('head'),
                'score' => $request->input('score'),
                'ansType' => "MCQ",
                'user_id' => auth()->user()->id,
                'CID' => 0
            ]);

        }else{
        $questionId = DB::table('questionBank')
            ->insertGetId([
                'head' => $request->input('head'),
                'score' => $request->input('score'),
                'ansType' => "MCQ",
                'user_id' => auth()->user()->id,
                'CID' => DB::table('courses')
                    ->where('name', '=', $request->input('course'))
                    ->where('user_id', '=', $user_id)
                    ->value('id')
            ]);
        }

        for ($i = 1; $i < 5; $i++) {
            $answer = new AnswersBank;
            $answer->answer = $request->input('answer' . (string)$i);
            $answer->QID = $questionId;
            if ($request->input('correct') == $i)
                $answer->isCorrect = 1;
            else
                $answer->isCorrect = 0;

            $answer->save();
        }

        return redirect()->action(
            [QuestionBankController::class, 'index']
        );;
    }
    public function createTF(){

        $user_id = auth()->user()->id;
        $courses = DB::table('courses')
            ->where('user_id', '=', $user_id)
            ->pluck('name', 'name');
            $coursesName = array_merge(['Without course' => 'Without Course'], $courses->all());
        return view('questionBank.createTF')->with('courses', $coursesName);
    }

    public function storeTF(Request $request){

        $this->validate($request, [
            'head' => 'required',
            'score' => 'required',
        ]);

        $user_id = auth()->user()->id;
        if($request->input('course') == 'Without course'){
            $questionId = DB::table('questionBank')
            ->insertGetId([
                'head' => $request->input('head'),
                'score' => $request->input('score'),
                'user_id' => auth()->user()->id,
                'CID' =>0,
                'ansType' => "TF"
            ]);

        }else{
        $questionId = DB::table('questionBank')
            ->insertGetId([
                'head' => $request->input('head'),
                'score' => $request->input('score'),
                'user_id' => auth()->user()->id,
                'CID' => DB::table('courses')
                    ->where('name', '=', $request->input('course'))
                    ->where('user_id', '=', $user_id)
                    ->value('id'),
                'ansType' => "TF"
            ]);
        }
        $fields = $request->input('answer');

        if ($fields == 'True') {

            $ansId = DB::table('answersBank')
                ->insertGetId(['answer' => 'true', 'QID' => $questionId, 'isCorrect' => 1]);
        } else {
            $ansId = DB::table('answersBank')
                ->insertGetId(['answer' => 'false', 'QID' => $questionId, 'isCorrect' => 0]);
        }

        return redirect()->action(
            [QuestionBankController::class, 'index']
        );;
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
        $user_id = auth()->user()->id;
        $question = questionBank::find($id);
        $answers = DB::table('answersBank')
            ->where('QID', '=', $id)->get();
        $correct = 0;
        if ($question->ansType == 'MCQ') {
            for ($i = 0; $i < 4; $i++) {
                if ($answers[$i]->isCorrect == 1) {
                    $correct = $i + 1;
                }
            }
        }
        $courses = DB::table('courses')
            ->where('user_id', '=', $user_id)
            ->pluck('name', 'name');

        $coursesName = array_merge(['Without course' => 'Without course'], $courses->all());

        return view('questionBank.edit' . $question->ansType)->with('question', $question)->with('answers', $answers)->with('correct', $correct)->with('coursesName', $coursesName);
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

        $user_id = auth()->user()->id;

        if($request->input('course') == 'Without course'){
            $question = questionBank::find($id);
        $question->head = $request->input('head');
        $question->score = $request->input('score');
        $question->CID=0;
        $question->save();
        }else{
        $question = questionBank::find($id);
        $question->head = $request->input('head');
        $question->score = $request->input('score');
        $question->CID=DB::table('courses')
        ->where('name','=',$request->input('course'))
        ->where('user_id','=',$user_id)
        ->value('id');
        $question->save();
        }
        $answers = DB::table('answersBank')
            ->where('QID', '=', $id)->pluck('id');

        for ($i = 0; $i < 4; $i++) {
            $answer = AnswersBank::find($answers[$i]);
            $answer->answer = $request->input('answer' . (string)($i + 1));
            $answer->QID = $id;
            if ($request->input('correct') == $i + 1)
                $answer->isCorrect = 1;
            else
                $answer->isCorrect = 0;

            $answer->save();
        }




        return redirect()->action(
            [QuestionBankController::class, 'index']
        );;
    }

    public function updateTF(Request $request, $id)
    {
        $user_id = auth()->user()->id;

        $question = questionBank::find($id);
        $question->head = $request->input('head');
        $question->score = $request->input('score');
        $question->CID=DB::table('courses')
        ->where('name','=',$request->input('course'))
        ->where('user_id','=',$user_id)
        ->value('id');
        $question->save();

        $answers = DB::table('answersBank')
            ->where('QID', '=', $id)->pluck('id');


        $answer = AnswersBank::find($answers[0]);

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

        return redirect()->action(
            [QuestionBankController::class, 'index']
        );;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMCQ($id)
    {
        $question = questionBank::find($id);
        $answers = DB::table('answersBank')
            ->where('QID', '=', $id)->pluck('id');
        for ($i = 0; $i < 4; $i++) {
            $answer = AnswersBank::find($answers[$i]);
            $answer->delete();
        }
        $question->delete();

        return redirect()->action(
            [QuestionBankController::class, 'index']
        );;
    }

    public function destroyTF($id)
    {
        $question = questionBank::find($id);
        $answers = DB::table('answersBank')
            ->where('QID', '=', $id)->pluck('id');

        $answer = AnswersBank::find($answers[0]);
        $answer->delete();
        $question->delete();

        return redirect()->action(
            [QuestionBankController::class, 'index']
        );;
    }



    public function filter(Request $request)
    {
        $user_id = auth()->user()->id;
        if ($request->input('course') == 'all') {
            return redirect('/questionBank');
        }

        $courseID = DB::table('courses')
            ->where('name', '=', $request->input('course'))
            ->value('id');

        $coursesName = DB::table('courses')
            ->where('user_id', '=', $user_id)
            ->pluck('name', 'name');


        $courses = DB::table('courses')
            ->where('name', '=', $request->input('course'))
            ->get();

        $questions = DB::table('questionBank')
            ->where('cID', '=', $courseID)
            ->get();

        $coursesName = array_merge(['all' => 'All courses'], $coursesName->all());

        $currentCourse = $request->input('course');
        return view('questionBank.index')->with('questions', $questions)
            ->with('courses', $courses)
            ->with('coursesName', $coursesName)
            ->with('currentCourse', $currentCourse);
    }

    public function import($id)
    {
        $user_id = auth()->user()->id;
        $quizzes = DB::table('quizzes')
            ->where('user_id', '=', $user_id)
            ->pluck('head', 'id');

        $question = questionBank::find($id);
        $answers = DB::table('answersBank')
            ->where('QID', '=', $id)->get();
        $correct = 0;
        if ($question->ansType == 'MCQ') {
            for ($i = 0; $i < 4; $i++) {
                if ($answers[$i]->isCorrect == 1) {
                    $correct = $i + 1;
                }
            }
        }

        return view('questionBank.import' . $question->ansType)
            ->with('question', $question)
            ->with('answers', $answers)
            ->with('correct', $correct)
            ->with('quiz', $quizzes);
    }

    public function importQuestionMCQ(Request $request)
    {

        $questionId = DB::table('question')
            ->insertGetId([
                'head' => $request->input('head'),
                'score' => $request->input('score'),
                'quiz_id' => $request->input('quiz'),
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


        return redirect()->action(
            [QuestionBankController::class, 'index']
        );;
    }

    public function importQuestionTF(Request $request)
    {

        $question = new Question;
        $question->head = $request->input('head');
        $question->score = $request->input('score');
        $question->ansType = 'TF';
        $question->quiz_id = $request->input('quiz');
        $question->save();

        $answers = DB::table('answersBank')
            ->where('QID', '=', $request->input('quiz'))->pluck('id');


        $answer = new answers;

        $fields = $request->input('answer');

        if ($fields == 'True') {

            $answer->answer = 'true';
            $answer->QID = $question->id;
            $answer->isCorrect = 1;
            $answer->save();
        } else {
            $answer->answer = 'false';
            $answer->QID = $question->id;
            $answer->isCorrect = 1;
            $answer->save();
        }

        return redirect()->action(
            [QuestionBankController::class, 'index']
        );;
    }
}
