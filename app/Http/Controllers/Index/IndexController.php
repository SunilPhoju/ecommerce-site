<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;

class IndexController extends Controller
{
    public function index()
    {
        $productsAll = Products::orderBy('id','DESC')->limit(6)->get();

        // showing category in index page
        $categories = Categories::with('categories')->where(['parent_id'=>'0'])->get();
      //  $categories = json_decode(json_encode($categories));
       /// foreach($categoryAll as $cat){
       // echo "<pre>"; print_r($categories); die;
        //    $sub_category = Categories::where(['parent_id'=>$cat->id])->get();

         //   foreach($sub_category as $subcat){
            //    echo $subcat->name; echo "<br>";
           // }
      //  }

        return view('index')->with(compact('productsAll','categories'));
    }
}
