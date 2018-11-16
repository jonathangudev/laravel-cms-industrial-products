<?php

use Faker\Generator as Faker;

$factory->define(App\Catalog\ProductType::class, function (Faker $faker) {
    return [
        'name' => $this->faker->words(2, true),
        'description' => $this->faker->text,
    ];
});
