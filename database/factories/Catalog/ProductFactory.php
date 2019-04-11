<?php

use Faker\Generator as Faker;

$factory->define(App\Catalog\Product::class, function (Faker $faker) {
    return [
        'name' => $this->faker->words(2, true),
        'attribute_template_id' => function () {
            return factory(App\Catalog\Product\AttributeTemplate::class)->create()->id;
        },
    ];
});
