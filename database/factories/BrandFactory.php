<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    return [
        'brandname' => $faker->unique()->name,
        'brand_status' => '1',
        'metatitle' => $faker->unique()->word,
        'slug' => $faker->unique()->name,
        'metakeywords' => $faker->unique()->text(),
        'metadescription' => $faker->unique()->word,
        'metacanonical' => $faker->unique()->url,
        'brand_logo' => 'brand_logo.png',
    ];
});
