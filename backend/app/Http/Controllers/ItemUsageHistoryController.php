<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
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

    public function items(){

        $items = Item::with('latestItemUsageHistory')->get();

        // 条件に合わないものを除く　$itemの数だけ繰り返す
        $filtered = $items->reject(function ($item, $key) {
            
            // dd($item->latestItemUsageHistory);

            $num = $item->disuse_month;//何ヶ月前

            //Carbonつかってdisuse_month月前を表現
            $date = \Carbon\Carbon::now()->subMonths($num)->format('Y-m-d 00:00:00'); 
            // dd($date);
            
            // 最新のuse_atを取得
            // 全てのitemにlatestItemUsageHistoryのリレーションが存在しないとエラーが出る
            $use_date = $item->latestItemUsageHistory->use_at;
            // dd($use_date);
            
            // \Log::info($date>$use_date);
            
            if($date>$use_date){
                // いらないものへスイッチ
                $item->is_unnecessary = true;
                $item->save();
                // $dateと$use_dateの比較　出力はtrue/false
                return true;
            }else{
                $item->is_unnecessary = false;
                $item->save();
                return false;
            }

        });

        // ソート済みコレクションはオリジナル配列のキーを保持しますので、valuesメソッドにより、連続した数字のインデックスにするためリセットしています
        return $filtered->sortBy('latestItemUsageHistory.use_at')->values()->take(5);
        // dd($filtered->sortBy('latestItemUsageHistory.use_at')->values()->take(5));

        // $date_3_month_ago = date('Y-m-d H:i:s',strtotime("-3 month"));

        //3ヶ月以内に使用したitem
        // $items_within_3month = Item::with('latestItemUsageHistory')->whereHas('itemUsageHistories', function ($query) use ($date_3_month_ago) {
        //     $query->where('use_at','>', $date_3_month_ago);
        // })->get();

        //使用履歴が古い順に5つ取得
        // $items_asc = $items_within_3month->sortBy('latestItemUsageHistory.use_at')->values()->take(5);
        //ソート済みコレクションはオリジナル配列のキーを保持しますので、valuesメソッドにより、連続した数字のインデックスにするためリセットしています。
        
        // return $items_asc;

        // 参考
        // User::whereHas('project', function ($query) use ($request) {
        //     $query->where('organization_id', $request->organization_id)});
        //     ->get();
        // useは変数を呼び出すための記述
    }
}
