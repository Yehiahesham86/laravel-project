<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $primarykey='id';
    protected $fillable=[
        'id',
    	'title', 	
        'content',
        'userid', 	
        'sectionid',
    ];
    public function Section(){

    
            return $this->belongsTo('App\Models\section', 'sectionid' );
        }
        public function User(){

    
            return $this->belongsTo('App\Models\User', 'userid' );
        }
       
}
