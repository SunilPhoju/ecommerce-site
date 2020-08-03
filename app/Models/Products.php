<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    public function attributes(){
        return $this->hasMany('App\Models\ProductsAttribute','product_id');
    }
    public function ratings()
    {
        return $this->hasMany('App\Models\Rating', 'product_id');
    }
}
