<?php

namespace App\Http\Controllers;


use Session;
use Auth;
use App\Models\totals;
use App\Models\orders;

use Illuminate\Http\Request;

class total extends Controller
{
    public function total(Request $request){
        $item=orders::find($okey=session('okey'));
        $user_id=Auth::user()->id;
        $sum=orders::select("*")->where('okey',$okey=session('okey'))->sum('total');
        $done=totals::create(['total'=>$sum,'okey'=>$okey = session('okey'),'customer'=>$request->customer,'paid'=>$request->Paids,'status'=>$request->statuss,'remains'=>$request->remians,'user_id'=>$user_id]);
        $okey=session()->forget('okey');
        return response()->json(['okey']);

     
     //return view('order',$arr);
      // return redirect()->back();
       
        
      }
}
