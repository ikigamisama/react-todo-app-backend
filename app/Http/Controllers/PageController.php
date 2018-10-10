<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $title = "Todo App By Franz Monzales";
        return view('pages.index')->with('title',$title);
    }
    public function about(){
        return view('pages.about');
    }
}
