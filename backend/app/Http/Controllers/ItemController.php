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
    
    // OK
    public function disuseItems(Category $category){
        $items=Item::where([
            ['user_id', Auth::user()->id],
            ['category_id', $category->id],
            ['is_unnecessary',1]
            ])->get();
        return $items;
    }

    // OK
    public function ownItems(Category $category){
        $items=Item::with('category')->where([
            ['user_id', Auth::user()->id],
            ['category_id', $category->id],
            ['is_unnecessary',0],
            ['want',0],
        ])->get();
        // dd($items);
        return $items;
    }

    // OK (urlを変更)
    public function wantItems(Category $category){
        $items=Item::where([
            ['user_id', Auth::user()->id],
            ['category_id', $category->id],
            ['is_unnecessary',false],
            ['want',true],
            ])->get();
        return $items;
    }

    // 認可
    // ユーザーの認証が通っていれば良いなら認可を使う必要はない
    // メソッドの引数はルーティングのルートパラメータにつながっている
    public function storeWantItem(StoreItemRequest $request, Category $category){
        $filePath = $request->item_image->store('public');
        $filePath = '/storage'.str_replace('public','',$filePath); 
        //$disuse_monthに制限を追加
        $validator = Validator::make($request->all(),[
            'disuse_month' => 'numeric|between:1,24'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $item = new Item;
        $item->user_id = Auth::user()->id;
        $item->name = $request->name;
        $item->amount = $request->amount;
        $item->place = $request->place;
        $item->purchase_from = $request->purchase_from;
        $item->purchase_date = $request->purchase_date;
        $item->disuse_month = $request->disuse_month;
        $item->url = $request->url;
        $item->memo = $request->memo;
        $item->image_path = $filePath;
        $item->category_id = $category->id;
        $item->want = false;
        $item->is_unnecessary = false;
        $item->itemUsageHistories->use_at = now();
        $item->save();
        return $item;
    }

    public function storeOwnItem(StoreItemRequest $request, Category $category){
        $filePath = $request->item_image->store('public');
        $filePath = '/storage'.str_replace('public','',$filePath); 
        //$disuse_monthに制限を追加
        $validator = Validator::make($request->all(),[
            'disuse_month' => 'numeric|between:1,24'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $item = new Item;
        // Authを使うにはweb.php上に書く必要あり
        $item->user_id = Auth::user()->id;
        $item->name = $request->name;
        $item->amount = $request->amount;
        $item->place = $request->place;
        $item->purchase_from = $request->purchase_from;
        $item->purchase_date = $request->purchase_date;
        $item->disuse_month = $request->disuse_month;
        $item->url = $request->url;
        $item->memo = $request->memo;
        $item->image_path = $filePath;
        $item->category_id = $category->id;
        $item->want = false;
        $item->is_unnecessary = false;
        $item->itemUsageHistories->use_at = now();
        $item->save();
        dd($item);
        return $item;
    }
    public function storeDisuseItem(Request $request, Category $category){
        $filePath = $request->item_image->store('public');
        $filePath = '/storage'.str_replace('public','',$filePath); 
        //$disuse_monthに制限を追加
        $validator = Validator::make($request->all(),[
            'disuse_month' => 'numeric|between:1,24'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $item = new Item;
        // Authを使うにはweb.php上に書く必要あり
        $item->user_id = Auth::user()->id;
        $item->name = $request->name;
        $item->amount = $request->amount;
        $item->place = $request->place;
        $item->purchase_from = $request->purchase_from;
        $item->purchase_date = $request->purchase_date;
        $item->disuse_month = $request->disuse_month;
        $item->url = $request->url;
        $item->memo = $request->memo;
        $item->image_path = $filePath;
        $item->category_id = $category->id;
        $item->want = false;
        $item->is_unnecessary = true;
        $item->itemUsageHistories->use_at = now();
        $item->save();
        dd($item);
        return $item;
    }
    public function update(UpdateItemRequest $request, Item $item){
        $item->name = $request->name;
        $item->amount = $request->amount;
        $item->place = $request->place;
        $item->purchase_from = $request->purchase_from;
        $item->purchase_date = $request->purchase_date;
        $item->disuse_month = $request->disuse_month;
        $item->url = $request->url;
        $item->memo = $request->memo;
        $item->save();
    }

    //コンポーネント上の表示
    public function destroy(Item $item){
        //引数にモデルを渡すとルートパラメータには自動でプライマリキーが入る
        $item->delete();
    }
}
