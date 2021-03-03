<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'categoryname' => $faker->unique()->name,
        'category_status' => '1',
        'metatitle' => $faker->unique()->word,
        'slug' => $faker->unique()->name,
        'metakeywords' => $faker->unique()->text(),
        'metadescription' => $faker->unique()->word,
        'metacanonical' => $faker->unique()->url,
        'category_image' => 'category.jpg',
    ];
});

