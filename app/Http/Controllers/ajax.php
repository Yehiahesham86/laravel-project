<?php

namespace App\Http\Controllers;

use App\Models\Prodect;
use Illuminate\Http\Request;

class ajax extends Controller
{
    public function index(){

        return view('/ajax');
    }

    public function add(Request $request){
       
        $prodect = new prodect();
        $prodect->pro_name = $request->pro_name;
        $prodect->price = $request->price;

        $prodect->save();
        return response()->json(['success'=>'Data is successfully added']);
        
    }
}
