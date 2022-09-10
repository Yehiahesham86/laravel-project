<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class web extends Controller
{

    function __construct(){
        $this->middleware('auth');
     }
     public function dashboard(){
        return view('dashboard-app');
     }

     public function table(){
        return view('table-app');
     }
     public function billing(){
      return view('billing-app');
   }
  
}
