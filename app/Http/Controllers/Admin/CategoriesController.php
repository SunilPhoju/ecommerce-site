<?php

namespace App\Http\Controllers\Admin;
use App\Models\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $category = Categories::all();

        $levels = Categories::where(['parent_id'=>'0'])->get();
        return view('admin.categories')->with('category',$category)->with(compact('levels'));
    }

    public function store(Request $request)
    {
        $category = new Categories;
        
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->description = $request->input('description');
        $category->url = $request->input('url');

        $category->save();
        return redirect('/categories')->with('status','Category added successfully');
         
    }

    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        $levels = Categories::where(['parent_id'=>'0'])->get();

        return view('admin.category.category-edit')->with('category',$category)->with(compact('levels'));
        
    }

    public function update(Request $request,$id)
    {
        $category = Categories::findOrFail($id);

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->url = $request->input('url');


        $category->update();

        return redirect('categories')->with('status','Category updated succesfully');
    }

    public function delete($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect('categories')->with('status','Category deleted');
    }
}
