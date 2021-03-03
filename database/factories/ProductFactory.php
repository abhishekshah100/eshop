<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_code' => $faker->name,
        'product_name' => $faker->name,
        'product_sku' => $faker->name,
        'product_category' => '1',
        'product_brand' => '1',
        'old_price' => '100',
        'new_price' => '90',
        'discount' => '10',
        'product_stock' => '10',
        'remaining_stock' => '10',
        'feature_image' => 'product.png',
        'product_images' => '["product.png"]',
        'product_description' => $faker->name,
        'metatitle' => $faker->unique()->word,
        'slug' => $faker->unique()->name,
        'metakeywords' => $faker->unique()->text(),
        'metadescription' => $faker->unique()->word,
        'product_status' => '1',
    ];
});
