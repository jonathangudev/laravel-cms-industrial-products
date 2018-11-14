<?php

use Faker\Generator as Faker;

$factory->define(App\Catalog\Product::class, function (Faker $faker) {
    return [
        'name' => $this->faker->words(2, true),
        'description' => $this->faker->text,
        'type_id' => function () {
            return factory(App\Catalog\ProductType::class)->create()->id;
        },
    ];
});
