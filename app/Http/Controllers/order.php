<?php

namespace App\Http\Controllers;

use App\Http\Controllers\order;

use Session;
use Auth;
use App\Models\customer;
use App\Models\orders;
use App\Models\Prodect;
use Illuminate\Http\Request;

class order extends Controller
{
  
    function __construct(){
        $this->middleware('auth');
    }
    


    public function add(Request $request){
  
      
             
      
    

  
       $pro=Prodect::select("*")->get();
    
       $arr['pro']=$pro;
       return view("order",$arr);
          
            
          } 
   
          public function delete(Request $request){
            
    
           $orders = orders::find( $request->del);
           $orders->delete();
           $sum=orders::select("*")->where('okey',$okey=session('okey'))->sum('total');
           $count = orders::where('okey',$okey=session('okey'))->count();
           $count1=$count+1;
           return response()->json(['sums'=>$sum,'count'=>$count1]);
        
         
           
       
        
           
            
          }

          public function update(Request $request){
            
       
            $orders = orders::find($request->up)->update(['price' => $request->price , 'qty'=>$request->qty , 'total'=>($request->price * $request->qty)]);
            $orders = orders::select("*")->where('id',$request->up)->get();
           
            $sum=orders::select("*")->where('okey',$okey=session('okey'))->sum('total');
            
            return response()->json(['sums'=>$sum,'orders'=>$orders]);
         
         
          
        }
        public function new_add(Request $request){

          $orders = new orders();
          $orders->user_id = Auth::user()->id;
          $orders->item_id = $request->item_id;
          $orders->product = $request->proname;
          $orders->prodectid = $request->proid;
          $orders->price = $request->proprice;
          $orders->qty = $request->proqty;
          $orders->customer =$request->customer;

          $orders->total = $request->proprice * $request->proqty;

    
          if(session()->has('okey')){$orders->okey= session('okey');}
          else{  $randomId =  rand(1,1000000000);
            $orders->okey=session()->put('okey', $randomId);  }
         
          
   
           $orders->save();
           $id=orders::select("*")->where('id',$orders->id)->get();
           $count = orders::where('okey',$okey=session('okey'))->count();
           $sum=orders::select("*")->where('okey',$okey=session('okey'))->sum('total');
           $count1 =$count+1; 
           return response()->json(['count'=>$count1,'id'=>$id ,'sums'=>$sum]);
          
          
       
          
          
            
        }
        public function fetch(Request $request)
        {
          $orders = orders::select("*")->where('okey',$okey=session('okey'))->get();
           $sum=orders::select("*")->where('okey',$okey=session('okey'))->sum('total');
           $count = orders::where('okey',$okey=session('okey'))->count();
           $customer=customer::select("*")->get();
           $count1 =$count+1; 
    
          return response()->json(['orders'=>$orders , 'sums'=>$sum ,'count'=>$count1,'customers'=>$customer]);
        }

        public function customer(Request $request)
        {
          $orders = new orders();
          $orders = orders::select("*")->where('okey',$okey=session('okey'))->update(['customer' => $request->customers]);
          
    
          return response()->json(['orders'=>$orders]);
        }

        public function pro(Request $request){

          $pro=prodect::select("*")->where('id',$request->proid)->get();
          return response()->json(['pro'=>$pro]);
        }

}
