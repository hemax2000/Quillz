<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\answers;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $question = Question::find($id);
        return view("answer.create")->with('question',$question);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $question = Question::find($id);

        if($question->ansType == "MCQ"){
            for ($i = 1; $i < 5; $i++){
            $answer = new answers;
            $answer-> answer = $request->input('answer'.(string)$i);
            $answer -> QID= $id;
            if ($request->input('correct')==$i)
            $answer -> isCorrect =1;
            else
            $answer -> isCorrect =0;
            
            $answer ->save();
            }
        }
        $fields = $request->input('result');

        if($fields == 'True'){

            $ansId= DB::table('answers')
                    ->insertGetId(['answer' => 'true' , 'QID' => $id ,'isCorrect'=> 1]);
            
            
            }
            else{
                $ansId= DB::table('answers')
                    ->insertGetId(['answer' => 'false' , 'QID' => $id ,'isCorrect'=> 1]);
            } 

            
            
            $quiz = Quiz::find($question->quiz_id);
            $questions = DB::table('question')
                            ->where('quiz_id','=',$quiz->id)->get();
            
        
        return view('questions.customizePage')->with("questions",$questions)
                                              ->with("quiz",$quiz);

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
