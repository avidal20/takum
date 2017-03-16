<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/*** Categories ****/

$factory->define(App\ProductCategory::class, function (Faker\Generator $faker) {
    return [
        'name_en' => $faker->name,
        'name_fr' => $faker->name,
        'description_en' => $faker->text,
        'description_fr' => $faker->text,
        'state' => 1,
    ];
});

/*** Products ****/

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name_en' => $faker->name,
        'name_fr' => $faker->name,
        'description_en' => $faker->text,
        'description_fr' => $faker->text,
        'state' => 1,
        'price' => $faker->randomDigit,
        'id_category' => random_int(\DB::table('md_products_categories')->min('id'), \DB::table('md_products_categories')->max('id')),
    ];
});