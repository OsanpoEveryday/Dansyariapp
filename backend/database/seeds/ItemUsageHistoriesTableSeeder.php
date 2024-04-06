<?php

use Illuminate\Database\Seeder;

class ItemUsageHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'item_id' => 1,
            'use_at' => date('Y-m-d H:i:s',strtotime("-4 month")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 2,
            'use_at' => date('Y-m-d H:i:s',strtotime("-5 month")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 3,
            'use_at' => date('Y-m-d H:i:s',strtotime("-4 month")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 4,
            'use_at' => date('Y-m-d H:i:s',strtotime("-3 month")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 5,
            'use_at' => date('Y-m-d H:i:s',strtotime("-32 day")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 6,
            'use_at' => date('Y-m-d H:i:s',strtotime("-53 day")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 7,
            'use_at' => date('Y-m-d H:i:s',strtotime("-23 day")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 8,
            'use_at' => date('Y-m-d H:i:s',strtotime("-17 day")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 9,
            'use_at' => date('Y-m-d H:i:s',strtotime("-40 day")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 10,
            'use_at' => date('Y-m-d H:i:s',strtotime("-30 day")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 11,
            'use_at' => date('Y-m-d H:i:s',strtotime("-20 day")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 12,
            'use_at' => date('Y-m-d H:i:s',strtotime("-50 day")),
        ];
        DB::table('item_usage_histories')->insert($param);
        $param = [
            'item_id' => 13,
            'use_at' => date('Y-m-d H:i:s',strtotime("-60 day")),
        ];
        DB::table('item_usage_histories')->insert($param);
    }
}
