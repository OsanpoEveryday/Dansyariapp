<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function getLinks(){
        $categories = Auth::user()->categories;
        $first_category_id = $categories->sortBy('id')->first()->id;
        $ownitems_link = '/ownitems/category/'.$first_category_id; 
        $wantitems_link = '/wantitems/category/'.$first_category_id; 
        $disuseitems_link = '/disuseitems/category/'.$first_category_id; 
        $select_link = '/select/'.$first_category_id; 
        return compact('ownitems_link','wantitems_link','disuseitems_link','select_link');
    }

    public function index(){
        $categories=Category::with('rules')->where('user_id', Auth::user()->id)->get();
        return $categories;
    }
    public function store(StoreCategoryRequest $request){
        $category=new Category;
        $category->user_id=Auth::id();
        $category->name=$request->name;
        $category->memo=$request->memo;
        $category->save();
    }
    // public function show(Category $category){
    //     return $category;
    // }
    //     public function show($categoryId)
    // {
    //       $category = Category::find($categoryId);
    //        return $category;
    // }
    // を簡略化した書き方
    public function update(UpdateCategoryRequest $request, Category $category){
        $category->name=$request->name;
        $category->memo=$request->memo;
        $category->save();
    }
    public function destroy(Category $category){
        $category->delete();
        return $category;
    }
}
