<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use App\Models\User;
use App\Models\answers;
use App\Models\courses;
use App\Models\questions;
use App\Models\questionBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class coursesController extends Controller
{
    public function index()
    {
        $user=auth()->user()->id;
        $courses=DB::table('courses')
        ->where('user_id', '=', $user)->get();
        return view('course.index')->with('courses',$courses);
    }
    public function createCourse()
    {
        return view('questionBank.createCourse');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            
        ]);

       
        $course = new courses;
        $course->name = $request->input('name');
        $course->chapters = 1;
        $course->user_id = auth()->user()->id;
        $course->save();

        return redirect('/questionBank')->with('success', 'Course added');

    }

    public function show($id)
    {
        $course = courses::find($id);
        return view('.show')->with('course', $course);
    }

    public function edit($id)
    {
        $course = courses::find($id);

        //check for correct user
        if(auth()->user()->id !== $course->user_id){
            return redirect('/quizzes')->with('error', 'Unauthorized Page');
        }
        return view('.edit')->with('course', $course);

    }

    public function destroy($id)
    {
        $course = courses::find($id);
        //check for correct user
        if(auth()->user()->id !== $course->user_id){
            return redirect('/')->with('error', 'Unauthorized Page');
        }
        $quizzes=Quiz::where('CID', $id)->get();

        foreach ($quizzes as $quiz) {
            $quiz->CID = 0;
            $quiz->save();
        }
        $questions=questionBank::where('CID', $id)->get();

        foreach ($questions as $question) {
            $question->CID = 0;
            $question->save();
        }
        $course->delete();
        return redirect('/questionBank')->with('success', ' Removed');

    }
}