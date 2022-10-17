<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // public function index(){
    //     return view('pages.index');
    // }

    public function index(){
        return view ('pages.index');
    }

    public function about(){
        return view ('pages.about');
    }

    public function features(){
        return view ('pages.features');
    }

    public function faqs(){
        return view ('pages.faqs');
    }
    public function test(){

        return view('test');
    }
}
