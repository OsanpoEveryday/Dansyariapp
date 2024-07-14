<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rule;
use App\Category;

class RuleController extends Controller
{
    public function index(){
        $categories = Category::with('rules')->get();
        return $categories;
    }

    public function category($categoryId){
        $category=Category::with('rules')->find($categoryId);
        return $category;
    }
    public function update(Request $request, Rule $rule){
        $rule->update($request->all());
        return $rule;
    }

    public function store(Request $request, Category $category){
        $rule = new Rule;
        $rule->category_id = $category->id;
        $rule->text = $request->text;
        $rule->save();
        return $rule;
    }

    public function destroy(Rule $rule){
        $rule->delete();
    }
}


