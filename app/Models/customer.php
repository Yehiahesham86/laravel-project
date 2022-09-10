<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table="customers";
    protected $primarykey="id";
    protected $fillable=[
        'id',
        'name',
        'phone'

    ];
    public function order(){
        $this->hasMany('App\Models\order','customer_id');
    }
}
