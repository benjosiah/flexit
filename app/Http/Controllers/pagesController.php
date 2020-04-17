<?php

namespace App\Http\Controllers;
use  App\Page;
use App\Page_post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class pagesController extends Controller
{
    public function getcreatepage()
    {
        return view('createPage');
    }
    public function getpage($page_id)
    {
        $page= Page::where('id',$page_id)->first();
        $page_posts=Page_post::where('page_id',$page_id)->orderby('id', 'desc')->get();
        return view('pages',['page'=>$page,'page_posts'=>$page_posts]);
    }
    public function createpage(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);

        $page= new Page();
        $page->name = $request['name'];
        $page->user_id = Auth::user()->id;
        $page->save();
        return redirect()->route('home');
    }

    public function getotp()
    {
        return view('confirm');
    }
    
}
