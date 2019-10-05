<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Post;
//use Faker\Generator as Faker;

$faker = Faker\Factory::create('ru_Ru');
$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'preview_text' => $faker->sentences(3, true),
        'body' => $faker->realText($maxNbChars = 2000, $indexSize = 2),
        'user_id' => $faker->numberBetween(1, 10),
        'category_id' => $faker->numberBetween(1, 10),
        'views' => $faker->numberBetween(0, 999),
        'preview_image' => 'lp' . rand(1, 5) . '.jpg',
        'preview_cover' => rand(1, 20) . '.jpg',
        'created_at' => $faker->dateTime,
    ];
});
