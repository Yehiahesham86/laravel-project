<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $table="orders";
    protected $primarykey="id";
    protected $fillable=[
        'id',
        'item_id',
        'product',
        'prodectid',
        'price',
        'qty',
        'total',
        'paid',
        'user_id',
        'customer',
  
        'okey',
    ];
    public function User_id(){
     
            return $this->belongsTo('App\Models\User', 'user_id');
        
    }
    public function Customer_name(){
     
        return $this->belongsTo('App\Models\order', 'customer_id');
    
}
public function Total(){
     
    return $this->belongsTo('App\Models\totals', 'okey');

}
}
