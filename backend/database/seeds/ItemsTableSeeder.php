<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'ミラノリブクルーネックセーター',
            'user_id' => '1',
            'category_id'=>'1',
            'number'=>'1',
            'amount'=>'8000',
            'place'=>'ラック',
            'purchase_from'=>'United Tokyo',
            'purchase_date'=>'2023/10/12',
            'image_path'=>'/storage/1082.jpeg',
            'is_unnecessary'=>0,
            'want'=>0,
            'memo'=>'マシンウォッシャブル'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'クルーネックTシャツ/半袖',
            'user_id' => '1',
            'category_id'=>'1',
            'number'=>'1',
            'amount'=>'3000',
            'place'=>'test',
            'purchase_from'=>'MAISON SPECIAL',
            'image_path'=>'/storage/1081.jpeg',
            'is_unnecessary'=>0,
            'want'=>0,
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'スウェットプルパーカー',
            'user_id' => '1',
            'category_id'=>'1',
            'number'=>'1',
            'amount'=>'3000',
            'place'=>'test',
            'purchase_from'=>'UNIQLO',
            'purchase_date'=>'2024/1/22',
            'image_path'=>'/storage/1084.jpeg',
            'is_unnecessary'=>0,
            'want'=>0,
            'memo'=>'This is test memo.'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'タックワイドパンツ',
            'user_id' => '1',
            'category_id'=>'1',
            'number'=>'1',
            'amount'=>'4000',
            'place'=>'test',
            'purchase_from'=>'UNIQLO',
            'image_path'=>'/storage/1090.jpeg',
            'is_unnecessary'=>0,
            'want'=>0,
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ5',
            'user_id' => '1',
            'category_id'=>'2',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'image_path'=>'',
            'is_unnecessary'=>0,
            'want'=>1,
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ6',
            'user_id' => '2',
            'category_id'=>'2',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'image_path'=>'',
            'is_unnecessary'=>0,
            'want'=>0,
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ7',
            'user_id' => '1',
            'category_id'=>'2',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'image_path'=>'',
            'is_unnecessary'=>0,
            'want'=>1,
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ8',
            'user_id' => '2',
            'category_id'=>'2',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'image_path'=>'',
            'is_unnecessary'=>1,
            'want'=>0,
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ9',
            'user_id' => '1',
            'category_id'=>'2',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'image_path'=>'',
            'is_unnecessary'=>0,
            'want'=>0,
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ10',
            'user_id' => '2',
            'category_id'=>'2',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'image_path'=>'',
            'is_unnecessary'=>0,
            'want'=>0,
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ11',
            'user_id' => '1',
            'category_id'=>'2',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'image_path'=>'',
            'is_unnecessary'=>1,
            'want'=>0,
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ12',
            'user_id' => '2',
            'category_id'=>'2',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'image_path'=>'',
            'is_unnecessary'=>0,
            'want'=>1,
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ13',
            'user_id' => '1',
            'category_id'=>'2',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'image_path'=>'',
            'is_unnecessary'=>0,
            'want'=>1,
        ];
        DB::table('items')->insert($param);
    }
}
