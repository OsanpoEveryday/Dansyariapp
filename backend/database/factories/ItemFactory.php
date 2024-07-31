<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use App\Category;
use App\User;

use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $this->faker->word,
        'category_id'=> function() {
            return factory(Category::class)->create()->id;
        },
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
    ];
});
