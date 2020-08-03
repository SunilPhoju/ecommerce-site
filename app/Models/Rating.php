<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'product_id','user_id','rating'
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
