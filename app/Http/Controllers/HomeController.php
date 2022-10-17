<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courses;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $courses = courses::orderBy('created_at', 'desc')->paginate(10)->where('user_id','=',$user_id);
        $coursesName= DB::table('courses')
                                ->where('user_id','=',$user_id)
                                ->pluck('name','name');
        $coursesName= array_merge(['all' => 'All Categories'], $coursesName->all());
        

        return view('home')->with('quizzes', $user->quizzes)
                            ->with('courses', $courses)
                            ->with('coursesName', $coursesName);
    }

    public function filter(Request $request)
    {
        $user_id = auth()->user()->id;
        if($request->input('course') == 'all'){ return redirect('/home');}
        
        $courseID=DB::table('courses')
                    ->where('name','=',$request->input('course'))
                    ->value('id');

        $coursesName= DB::table('courses')
                        ->where('user_id','=',$user_id)
                        ->pluck('name','name');
                    

        $courses=DB::table('courses')
                ->where('name','=',$request->input('course'))
                ->get();

    $quizzes= DB::table('quizzes')
                ->where('CID','=',$courseID)
                ->get();

        $coursesName= array_merge(['all' => 'All courses'], $coursesName->all());
        return view('home')->with('quizzes', $quizzes)
                            ->with('courses', $courses)
                            ->with('coursesName', $coursesName);
    }
}
