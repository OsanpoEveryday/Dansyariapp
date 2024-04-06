<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::where('user_id', Auth::user()->id)->get();
        return $categories;
    }
    public function store(Request $request){
        // \Log::info(Auth::id());
        $category=new Category;
        $category->user_id=Auth::id();
        $category->name=$request->name;
        $category->save();
        return $category;
    }
    public function show(Category $category){
        return $category;
    }
//     public function show($categoryId)
// {
//       $category = Category::find($categoryId);
//        return $category;
// }
// を簡略化した書き方
    public function update(Request $request, Category $category){
        $category->update($request->all());
        return $category;
    }
    public function destroy(Category $category){
        $category->delete();
        return $category;
    }
}
