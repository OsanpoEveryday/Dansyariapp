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
            'amount'=>'3000',
            'place'=>'ラック',
            'purchase_from'=>'UNIQLO',
            'disuse_month'=>1,
            'purchase_date'=>'2023/10/12',
            'image_path'=>'/storage/us6YYOgrKLmKac5srwHQ4CpaUWUjidsqxk2leuhl.jpg',
            'is_unnecessary'=>0,
            'want'=>0,
            'memo'=>'ある日の暮方の事である。一人の下人げにんが、羅生門らしょうもんの下で雨やみを待っていた。
            　広い門の下には、この男のほかに誰もいない。ただ、所々丹塗にぬりの剥はげた、大きな円柱まるばしらに、蟋蟀きりぎりすが一匹とまっている。羅生門が、朱雀大路すざくおおじにある以上は、この男のほかにも、雨やみをする市女笠いちめがさや揉烏帽子もみえぼしが、もう二三人はありそうなものである。それが、この男のほかには誰もいない。
            　何故かと云うと、この二三年、京都には、地震とか辻風つじかぜとか火事とか饑饉とか云う災わざわいがつづいて起った。そこで洛中らくちゅうのさびれ方は一通りではない。旧記によると、仏像や仏具を打砕いて、その丹にがついたり、金銀の箔はくがついたりした木を、路ばたにつみ重ねて、薪たきぎの料しろに売っていたと云う事である。洛中がその始末であるから、羅生門の修理などは、元より誰も捨てて顧る者がなかった。するとその荒れ果てたのをよい事にして、狐狸こりが棲すむ。盗人ぬすびとが棲む。とうとうしまいには、引取り手のない死人を、この門へ持って来て、棄てて行くと云う習慣さえ出来た。そこで、日の目が見えなくなると、誰でも気味を悪るがって、この門の近所へは足ぶみをしない事になってしまったのである。'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ2',
            'user_id' => '2',
            'category_id'=>'2',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'image_path'=>'',
            'disuse_month'=>2,
            'is_unnecessary'=>1,
            'want'=>0,
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ3',
            'user_id' => '1',
            'category_id'=>'1',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'purchase_date'=>'2024/1/22',
            'image_path'=>'',
            'disuse_month'=>3,
            'is_unnecessary'=>0,
            'want'=>0,
            'memo'=>'テストメモ　テストメモ　テストメモ'
        ];
        DB::table('items')->insert($param);
        $param = [
            'name' => 'テストデータ4',
            'user_id' => '2',
            'category_id'=>'2',
            'number'=>'1',
            'amount'=>'5000',
            'place'=>'test',
            'purchase_from'=>'test',
            'image_path'=>'',
            'disuse_month'=>4,
            'is_unnecessary'=>1,
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
            'disuse_month'=>5,
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
            'disuse_month'=>1,
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
            'disuse_month'=>2,
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
            'disuse_month'=>3,
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
            'disuse_month'=>4,
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
            'disuse_month'=>5,
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
            'disuse_month'=>1,
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
            'disuse_month'=>2,
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
            'disuse_month'=>3,
            'is_unnecessary'=>0,
            'want'=>1,
        ];
        DB::table('items')->insert($param);
    }
}
