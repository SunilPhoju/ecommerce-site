<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //protected $table = 'categories';
   // protected $fillable = ['title','subtitle','description'];

    public function categories(){
        return $this->hasMany('App\Models\Categories','parent_id');
    }

   
    
}
