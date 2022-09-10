<?php

namespace App\Http\Controllers;
use App\Models\post;
use App\Models\user;
use App\Models\section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    {   //$section=post::find(1);
        //dd($section->User);
       // $user=Auth::user();
        //dd($user->section);
        return view('home');
    }
}
