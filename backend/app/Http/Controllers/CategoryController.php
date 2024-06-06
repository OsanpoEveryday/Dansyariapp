<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::with('rules')->where('user_id', Auth::user()->id)->get();
        return $categories;
    }

    public function getFirstCategory(){
        $first_category = Category::where('user_id', Auth::user()->id)->first()->get();
        \Log::info($first_category);
    }

    public function store(Request $request){
        // \Log::info(Auth::id());
        $category=new Category;
        $category->user_id=Auth::id();
        $category->name=$request->name;
        $category->memo=$request->memo;
        $category->rule1=$request->rule1;
        $category->rule2=$request->rule2;
        $category->rule3=$request->rule3;
        $category->rule4=$request->rule4;
        $category->rule5=$request->rule5;
        $category->save();
    }
    // public function show(Category $category){
    //     return $category;
    // }
    // は
    //     public function show($categoryId)
    // {
    //       $category = Category::find($categoryId);
    //        return $category;
    // }
    // を簡略化した書き方
    public function update(Request $request, Category $category){
        $category->name=$request->name;
        $category->memo=$request->memo;
        $category->rule1=$request->rule1;
        $category->rule2=$request->rule2;
        $category->rule3=$request->rule3;
        $category->rule4=$request->rule4;
        $category->rule5=$request->rule5;
        $category->save();
    }
    public function destroy(Category $category){
        $category->delete();
        return $category;
    }
}
