<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class CategoryShowTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexCategories()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/api/categories');

        $response->assertStatus(200);
    }
}
