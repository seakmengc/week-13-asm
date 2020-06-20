<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'category_id' => factory(Category::class),
        'title' => $faker->word,
        'content' => $faker->word,
        'author_id' => $faker->numberBetween(1, 10)
    ];
});
