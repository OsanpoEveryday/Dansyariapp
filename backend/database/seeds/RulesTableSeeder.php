<?php

use Illuminate\Database\Seeder;

class RulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'category_id'=>'1',
            'text'=>'洗濯できる',
        ];
        DB::table('rules')->insert($param);

        $param = [
            'category_id'=>'1',
            'text'=>'3年使える',
        ];
        DB::table('rules')->insert($param);
    }
}
