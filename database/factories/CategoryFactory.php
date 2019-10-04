<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Category;
//use Faker\Generator as Faker;
use Illuminate\Support\Str;

$faker = Faker\Factory::create('ru_Ru');
$factory->define(Category::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->words(2, true);
    $slug = Str::slug($name, '-');
    return [
        'name' => $name,
        'slug' => $slug,
    ];
});
