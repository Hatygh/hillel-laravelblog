<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Tag;
//use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$faker = Faker\Factory::create('ru_Ru');
$factory->define(Tag::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->word;
    $slug = Str::slug($name, '-');
    return [
        'name' => $name,
        'slug' => $slug,
    ];
});
