<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Comment;
//use Faker\Generator as Faker;

$faker = Faker\Factory::create('ru_Ru');
$factory->define(Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'post_id' => $faker->numberBetween(1, 50),
//        'parentComment_id' => 0,
        'likes' => 0,
        'body' => $faker->sentences(3, true),
        'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
    ];
});
