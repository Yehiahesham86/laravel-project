<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Auth;
use App\Models\orders;
use App\Models\Prodect;
use App\Models\totals;

class totalpage extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view("total");
    }
    public function total(Request $request){
 
       
        $total= new total;
        $from =$request->from;
        $to =$request->to;
        
        if($from==0){
            $done=totals::select("*")->whereDate('created_at','<=',$to)->get();
            $sum=totals::select("*")->whereDate('created_at','<=',$to)->sum('total');

        }
        elseif($to==0){
            $done=totals::select("*")->whereDate('created_at','>=',$from)->get();
            $sum=totals::select("*")->whereDate('created_at','>=',$from)->sum('total');

        }
        else{          
              $done=totals::select("*")->whereDate('created_at','>=',$from)->whereDate('updated_at','<=',$to)->get();
              $sum=totals::select("*")->whereDate('created_at','>=',$from)->whereDate('updated_at','<=',$to)->sum('total');

        }
        
            
            
        return response()->json(['sums'=>$sum,'total'=>$done]);
         
   
            
    
    
        }
      
            
      
        public function showmore(Request $request){
            $total= new total;
            $okey=$request->okey;
            $done=orders::select("*")->where('okey',$okey)->get();

            return response()->json(['details'=>$done]);

        }
    
          

        
                  
                
        
        
    }

