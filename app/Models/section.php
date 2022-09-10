<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    use HasFactory;
    protected $table="sections";
    protected $primarykey="id";
    protected $fillable=[
        'id',
        'name',
        'admin',

    ];
    public function Admin()
    {
        return $this->belongsTo('App\Models\User','admin');
    } 

    public function Post(){
      
        return $this->hasMany('App\Models\post', 'sectionid');
    }

}
