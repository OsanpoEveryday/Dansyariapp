<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use Validator;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function ownItems(Category $category){
        $items=Item::with('category')->where([
            ['user_id', Auth::user()->id],
            ['category_id', $category->id],
            ['is_unnecessary',0],
            ['want',0],
            ])->get();
            return $items;
    }
    public function wantItems(Category $category){
        $items=Item::where([
            ['user_id', Auth::user()->id],
            ['category_id', $category->id],
            ['is_unnecessary',false],
            ['want',true],
            ])->get();
            return $items;
    }
    public function disuseItems(Category $category){
        $items=Item::where([
            ['user_id', Auth::user()->id],
            ['category_id', $category->id],
            ['is_unnecessary',1]
            ])->get();
        return $items;
    }
    public function storeWantItem(StoreItemRequest $request, Category $category){
        $item = new Item;
        $item->user_id = Auth::user()->id;
        $item->name = $request->name;
        $item->amount = $request->amount;
        $item->place = $request->place;
        $item->purchase_from = $request->purchase_from;
        $item->purchase_date = $request->purchase_date;
        $item->url = $request->url;
        $item->memo = $request->memo;
        $item->category_id = $category->id;
        $item->want = true;
        $item->is_unnecessary = false;
        $item->itemUsageHistories->use_at = now();
        if($request->item_image){
            $filePath = $request->item_image->store('public');
            $filePath = '/storage'.str_replace('public','',$filePath); 
            $item->image_path = $filePath;
        }
        $item->save();
        return $item;
    }
    public function storeOwnItem(StoreItemRequest $request, Category $category){
        // Authを使うにはweb.php上に書く必要あり
        $item = new Item;
        $item->user_id = Auth::user()->id;
        $item->name = $request->name;
        $item->amount = $request->amount;
        $item->place = $request->place;
        $item->purchase_from = $request->purchase_from;
        $item->purchase_date = $request->purchase_date;
        $item->url = $request->url;
        $item->memo = $request->memo;
        $item->category_id = $category->id;
        $item->want = false;
        $item->is_unnecessary = false;
        $item->itemUsageHistories->use_at = now();
        if($request->item_image){
            $filePath = $request->item_image->store('public');
            $filePath = '/storage'.str_replace('public','',$filePath); 
            $item->image_path = $filePath;
        }
        $item->save();
        return $item;
    }
    public function update(UpdateItemRequest $request, Item $item){
        $item->name = $request->name;
        $item->amount = $request->amount;
        $item->place = $request->place;
        $item->purchase_from = $request->purchase_from;
        $item->purchase_date = $request->purchase_date;
        $item->url = $request->url;
        $item->memo = $request->memo;
        $item->save();
    }
    public function moveToDisuseItem(Request $request, Item $item){
        $item->is_unnecessary = true;
        $item->save();
    }
    public function moveToOwnItem(Request $request, Item $item){
        $item->want = false;
        $item->is_unnecessary = false;
        $item->save();
    }
    public function destroy(Item $item){
        //引数にモデルを渡すとルートパラメータには自動でプライマリキーが入る
        $item->delete();
    }
}
