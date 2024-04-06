<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'ファッション',
            "user_id"=> 1
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => '家具',
            "user_id"=> 1
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => '家電',
            "user_id"=> 1
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => '日用品',
            "user_id"=> 1
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => '書籍',
            "user_id"=> 1
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => 'インテリア',
            "user_id"=> 1
        ];
        DB::table('categories')->insert($param);
    }
}
