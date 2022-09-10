<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class totals extends Model
{
    use HasFactory;
    protected $table="totals";
    protected $primarykey="id";
    protected $fillable=[
        'id',
        'total',
        'customer',
        'paid',
        'status',
        'remains',
        'user_id',
        'okey',
    ];
    public function okey(){
     
        return $this->hasMany('App\Models\orders', 'okey');
    
    }
    public function User_id(){
     
        return $this->belongsTo('App\Models\User', 'user_id');
    
}
}
