<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\answers;
use App\Models\courses;
use App\Models\Question;
use App\Models\participant;
use App\Models\questionBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizzesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::orderBy('created_at', 'desc')->paginate(10);

        return view('quizzes.index')->with('quizzes', $quizzes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = auth()->user()->id;
        $courses=DB::table('courses')
                ->where('user_id','=',$user_id)
                ->pluck('name','name');
                $coursesName = array_merge(['Without course' => 'Without Course'], $courses->all());
                // $quizType = array_merge(['game' => 'Game Based Quiz','formal' => 'Formal Quiz']);
                return view('quizzes.create')->with('coursesName', $coursesName)
                                                ->with('type',$request->type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;

        $this->validate($request, [
            'head' => 'required',
            'course' => 'required',
            'duration' => 'required',
            // 'quizType'=>'required'
        ]);

        
        if($request->input('course') == 'Without course'){
            $quizId= DB::table('quizzes')
                            ->insertGetId([
                        'head' => $request->input('head') ,
                        'quiz_type'=>$request->input('type'),
                        'CID' => 0,
                        'user_id'=> auth()->user()->id,
                        'duration' => $request->input('duration') 
            ]);
        }
        else{
        $quizId= DB::table('quizzes')
                    ->insertGetId([
                    'head' => $request->input('head') ,
                    'quiz_type'=>$request->input('type'),
                    // 'quiz_type'=>$request->input('quiz_type'),
                    'CID' => DB::table('courses')
                                ->where('name','=',$request->input('course'))
                                ->where('user_id','=',$user_id)
                                ->value('id') ,
                    'user_id'=> auth()->user()->id,
                    'duration' => $request->input('duration') 
                ]);
            }
        

        return redirect()->action(
            [QuestionController::class, 'index'], ['id' => $quizId]
        )->with('success', 'Quiz Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::find($id);
        return view('quizzes.show')->with('quiz', $quiz);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::find($id);
        $user_id = auth()->user()->id;
        //check for correct user


        if(auth()->user()->id !== $quiz->user_id){
            return redirect('/quizzes')->with('error', 'Unauthorized Page');
        }


        $courses=DB::table('courses')
                ->where('user_id','=',$user_id)
                ->pluck('name','name');

        return view('quizzes.edit')->with('quiz', $quiz)
                                    ->with('courses', $courses);
                                    

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'head' => 'required',
            'course' => 'required',
            'duration' => 'required',
        ]);

        //Create a quiz
        $quiz = Quiz::find($id);
        $quiz->head = $request->input('head');
        $quiz->duration = $request->input('duration');
        $quiz->CID = DB::table('courses')
                    ->where('name','=',$request->input('course'))
                    ->value('id');
        $quiz->save();

        return redirect()->action(
            [QuestionController::class, 'index'], ['id' => $id]
        );;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        
        //check for correct user
        if(auth()->user()->id !== $quiz->user_id){
            return redirect('/quizzes')->with('error', 'Unauthorized Page');
        }
        $quiz->delete();
        return redirect('/home')->with('success', 'Quiz Removed');

    }

    public function saveCode(Request $request, $id){
        
        if($Codes = DB::table('quizzes')->where('code', $request->input('code'))->exists()){
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            $courses = courses::orderBy('created_at', 'desc')->paginate(10);
            $coursesName= DB::table('courses')
                                    ->where('user_id','=',$user_id)
                                    ->pluck('name','name');
            $coursesName= array_merge(['all' => 'All courses'], $coursesName->all());
            

            return redirect('/home')->with('quizzes', $user->quizzes)
                                ->with('courses', $courses)
                                ->with('coursesName', $coursesName)
                                ->with('danger', 'Code Taken');
        }
        
        $questions = DB::table('question')->where('quiz_id','=',$id);

        if (!($questions->exists())) {
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            $courses = courses::orderBy('created_at', 'desc')->paginate(10);
            $coursesName= DB::table('courses')
                                    ->where('user_id','=',$user_id)
                                    ->pluck('name','name');
            $coursesName= array_merge(['all' => 'All courses'], $coursesName->all());
            

            return redirect('/home')->with('quizzes', $user->quizzes)
                                ->with('courses', $courses)
                                ->with('coursesName', $coursesName)
                                ->with('danger', 'Quiz Empty');
        }

        $quiz = Quiz::find($id);
        $quiz -> code = $request->input('code');
        $quiz->save();

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $courses = courses::orderBy('created_at', 'desc')->paginate(10);
        $coursesName= DB::table('courses')
                                ->where('user_id','=',$user_id)
                                ->pluck('name','name');
        $coursesName= array_merge(['all' => 'All courses'], $coursesName->all());
        

        return view('home')->with('quizzes', $user->quizzes)
                            ->with('courses', $courses)
                            ->with('coursesName', $coursesName)
                            ->with('success', 'Code saved');
    
    }
    public function showResult($id)
    {
        $quiz = Quiz::find($id);

        $participants=participant::where('quiz_id', $id)->get();

        $questions = DB::table('question')
                    ->where('quiz_id','=',$id)->get();
        $totalScore=0;
        foreach($questions as $question){
            $totalScore+= $question->score;
        }

        foreach ($participants as $participant) {
            if($participant->score > $totalScore){
                $participant->score = $totalScore;
                $participant->save();
            }
        }


        return view('quizzes.quizResult')->with('participants', $participants)->with('quiz',$quiz)->with('totScore',$totalScore);
    }

    // public function showResultGb($id)
    // {
    //     $quiz = Quiz::find($id);
    //     $participant=DB::table('participant')
    //     ->where('quiz_id','=',$id)
    //     ->get();
        
    //     $questions = DB::table('question')
    //                 ->where('quiz_id','=',$id)->get();
    //     $totalScore = 0;
    //     foreach($questions as $question){
    //         $totalScore += $question->score;
    //     }
    //     return view('quizzes.QuizResultGb')->with('participants', $participant)->with('quiz',$quiz)->with('totScore',$totalScore);
    // }

    public function deactivateQuiz($id)
    {
        $quiz = Quiz::find($id);
        $quiz -> code = null;
        $quiz->save();

        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $courses = courses::orderBy('created_at', 'desc')->paginate(10);
        $coursesName= DB::table('courses')
                                ->where('user_id','=',$user_id)
                                ->pluck('name','name');
        $coursesName= array_merge(['all' => 'All courses'], $coursesName->all());
        

        return redirect('/home')->with('quizzes', $user->quizzes)
                            ->with('courses', $courses)
                            ->with('coursesName', $coursesName)
                            ->with('danger', 'quiz ded');
    }

    public function resetResult($id)
    {
        $quiz = Quiz::find($id);
        $participants=DB::table('participant')
        ->where('quiz_id','=',$id)->get();

        foreach ($participants as $participant) {
            participant::find($participant->id)->delete();
        }

        return redirect('/quiz/result/'.$quiz->id)->with('success', 'Result have been deleted');
    }

}
