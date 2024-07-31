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
            'memo'=>'服を選ぶ基準は人それぞれ。ブランド、デザイン、価格などさまざまな観点で選んでいると思います。服が好きな人にとって、それは当たり前のことですが、そうでない人からは「どう服を選べばいいのかわからない」という悩みを聞くことも。

            こういった悩み相談をされることが多いことから、「感覚的ではなく左脳的でロジカルな考えによる服の選び方」について、いくつか図解してみたところ、たくさんの方々から反響をいただきました。ということで今回は、それらをまとめて紹介してみたいと思います。
            
            いくつかの考え方に基づいて提案していますので、自分に合った方法を見つけて、服選びに役立ててみてください。',
            "user_id"=> 1,
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => '家具',
            "user_id"=> 1,
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

        $param = [
            'name' => 'ファッション',
            'memo'=>'メモ',
            "user_id"=> 2,
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => '家具',
            "user_id"=> 2,
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => '家電',
            "user_id"=> 2
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => '日用品',
            "user_id"=> 2
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => '書籍',
            "user_id"=> 2
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => 'インテリア',
            "user_id"=> 2
        ];
        DB::table('categories')->insert($param);
    }
}
