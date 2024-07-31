<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Item;
use App\Category;
use App\User;

class ItemTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testOwnItemsShow()
    {

        $user = factory(User::class)->create();
        $category = factory(Category::class)->create([
            'user_id' => $user->id,
        ]);
        $item = factory(Item::class)->create([
            'category_id' => $category->id,
        ]);
        $response = $this->get('/ownitems/category/'.$item->category_id);

        $response->assertStatus(200);
    }

    // public function testCreate()
    // {

    //     $user = factory(User::class)->create();

    //     $category = factory(Category::class)->create([
    //         'user_id' => $user->id,
    //     ]);
    //     $item = factory(Item::class)->create([
    //         'category_id' => $category->id,
    //     ]);

    //     $itemData = [
    //         'disuse_month' => '12',
    //         'name'=>'テストアイテム',
    //         'item_image'=>'',
    //         'number'=>'1',
    //         'amount'=>'5000',
    //         'place'=>'place',
    //         'purchase_from'=>'store',
    //         'url'=> '',
    //         'memo'=> 'testmemo',
    //     ];
    //     // $response = $this->actingAs($user)->post('/storeownitem/'.$item->category_id);
    //     // dd(route('Item.store',['category'=>$item->category_id]));
    //     $this->actingAs($user);
    //     $this->assertAuthenticatedAs($user); //認証されているかをテスト
    //     $response = $this->actingAs($user)->post(route('Item.store',['category'=>$item->category_id]),$itemData);

    //     $response->assertStatus(201);
    //     // \Log::info($response->getContent());
    //     \Log::info($user->id);
    //     \Log::info($category->id);
    //     \Log::info($item->id);
    // }
}
