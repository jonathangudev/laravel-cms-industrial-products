<?php

use Faker\Generator as Faker;

$factory->define(App\Catalog\Product\AttributeSet::class, function (Faker $faker) {
    return [
        'name' => $this->faker->words(2, true),
    ];
});
