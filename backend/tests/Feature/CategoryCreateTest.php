<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Faker\Factory as Faker;

// vendor/bin/phpunit --filter CategoryCreateTest

class CategoryCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateCateogory()
    {
        $faker = Faker::create();

        $user = factory(User::class)->create();

        $categoryData = [
            'user_id' => $user->id,
            'name' => $faker->word,
            'memo' => $faker->text,
        ];

        $response = $this->actingAs($user)->post('/api/categories', $categoryData);
        $response->assertStatus(200);
    }
}
