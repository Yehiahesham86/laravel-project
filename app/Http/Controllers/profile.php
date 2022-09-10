<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\user;
use Illuminate\Http\Request;

class profile extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }
    public function profile(Request $request){
        $userid=Auth::user()->id;
        $user=user::find($userid);
    
        if ($request->isMethod( method:'post' )) {
         
             $user->update($request->all());
            return redirect()->back();
            }else{  
                 
              
                $arr['user']=$user;
                return view('/profile',$arr);
            }
     


    }

}
