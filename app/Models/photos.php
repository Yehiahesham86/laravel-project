<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class photos extends Model
{
    use HasFactory;
    protected $table='photos';
    protected $primarykey='id';
    protected $fillable=[
        'id',
    	'path', 	
       
    ];
}
