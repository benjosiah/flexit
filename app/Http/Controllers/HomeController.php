<?php

namespace App\Http\Controllers;
use  App\Page;
use App\Page_post;
use App\User;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages_post=Page_post::orderby('created_at', 'desc')->get();
        return view('home',['pages_post'=>$pages_post]);
    }
}
