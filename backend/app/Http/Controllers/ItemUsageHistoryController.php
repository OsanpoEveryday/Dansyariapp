<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\ItemUsageHistory;
use Illuminate\Support\Facades\DB;

class ItemUsageHistoryController extends Controller
{
    public function recordTime(Request $request){
        $history = new ItemUsageHistory;
        $history->use_at = now();
        $history->item_id = $request->item_id;
        $history->save();
        return $history;
    }
    public function recordNull(Request $request){
        $history = new ItemUsageHistory;
        $history->item_id = $request->item_id;
        $history->save();
        return $history;
    }

    public function getAndSortItems(Category $category){
        $items = Item::with('latestItemUsageHistory')->where([
            ['category_id',$category->id],
            ['is_unnecessary',0],
            ['want',0],
        ])->get();
        $sort_items = $items->sortBy('latestItemUsageHistory.use_at')->values();
        \Log::info($sort_items);
        return $sort_items;
    }
}
