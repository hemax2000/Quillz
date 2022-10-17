<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courses;
use App\Models\answers;
use App\Models\questionBank;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class ActiveQuizController extends Controller
{

    public function checkCode(Request $request)
    {

        if(DB::table('quizzes')->where('code', $request->input('code'))->exists()){
            return redirect("/".$request->input('code'));
        }
        else{
                return redirect('/')->with('error', 'code not found');
        }
        
    }

    public function createName($code)
    {
        
        $quiz = DB::table('quizzes')->where('code', $code)->first();
        return view("ActiveNonQuiz.storeName")->with('quiz',$quiz->id)->with('time',$quiz->duration);
    }

    public function storeName(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            
        ]);

        $participant = new participant;
        $participant->name = $request->input('name');
        $participant->quiz_id =$id;
        $participant->score =0;
        $participant->save();

        

        return redirect('/quiz/takeQuiz/'.$participant->id);

    }
    public function takeQuiz($id)
    {
        $participant=participant::find($id);
        $quiz = Quiz::find($participant->quiz_id);
        $questions = DB::table('question')
                    ->where('quiz_id','=',$participant->quiz_id)->get();
         if($quiz->quiz_type == 'gb') {
            return view("ActiveNonQuiz.takeQuizGameBased")->with('quiz',$quiz)->with('questions',$questions)->with('participant', $participant); 
         }          
        return view("ActiveNonQuiz.takeQuiz")->with('quiz',$quiz)->with('questions',$questions)->with('participant', $participant);
    }

    public function calcScore(Request $request,$id)
    {
        $score=0;
        $counter=1;
        $answers=[];
        $participant=participant::find($id);
        $questions = DB::table('question')
                    ->where('quiz_id','=',$participant->quiz_id)->get();
        
        foreach($questions as $question){
            if($question->ansType == "MCQ"){
                $answer= answers::find($request->input('answer'.(string)$counter));
                if($answer->isCorrect==1){
                    $score+=$question->score;
                }
                $answers[]=answers::find($request->input('answer'.(string)$counter))->answer;
            }
            else{
                if($request->input('answer'.(string)$counter) == DB::table('answers')->where('QID','=',$question->id)->value('answer')){
                    $score+=$question->score;
                }
                $answers[]=$request->input('answer'.(string)$counter);
            }
            
            $counter++;
        }

        $participant->score=$score;
        $participant->save();
        return view("ActiveNonQuiz.quizResult")->with('participant', $participant)->with('questions',$questions)->with('answers',$answers);
    }

    public function calcScoreGameBased(Request $request,$id){
        $score=0;
        $counter=1;
        $countCorrect = 0; //To store the number of questions solved correctly
        $submitTime = $request->input('timeR'); //To store the time is spent by participant to finish the quiz
        $finalScore = 0; //To store final result of Accuracy-Speed algorithm
        $accuracy = 0; //To store number of correct of questions solved correctly over total number of quiz questions
        $speed = 0; //To store number of solved question over consumed time
        $answers=[];
        $participant = participant::find($id);
        $quiz = Quiz::find($participant->quiz_id);
        $time =  ($quiz->duration * 60) - $submitTime;
        $questions = DB::table('question')
                    ->where('quiz_id','=',$participant->quiz_id)->get();
        foreach($questions as $question){
            if($question->ansType == "MCQ"){
                $answer= answers::find($request->input('answer'.(string)$counter));
                if($answer->isCorrect==1){
                    $score+=$question->score;
                    $countCorrect++;
                }
                $answers[]=answers::find($request->input('answer'.(string)$counter))->answer;
            }
            else{
                if($request->input('answer'.(string)$counter) == DB::table('answers')
                ->where('QID','=',$question->id)->value('answer')){
                    $score+=$question->score;
                    $countCorrect++;
                }
                $answers[]=$request->input('answer'.(string)$counter);
            }
            $counter++;
        }
        $accuracy = $countCorrect/$questions->count();
        $speed = $questions->count()/$time;
        $finalScore = $speed * $accuracy;
        $participant->score=$finalScore*100;
        $participant->save();
        $participants = DB::table('participant')
        ->where('quiz_id','=',$quiz->id)
        ->orderBy('score', 'desc')
        ->get();
        return view("ActiveNonQuiz.leaderboard")->with('participants', $participants)
        ->with('questions',$questions)->with('answers',$answers);
    }
    
}
