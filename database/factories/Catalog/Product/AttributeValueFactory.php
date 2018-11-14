<?php

use Faker\Generator as Faker;

$factory->define(App\Catalog\Product\AttributeValue::class, function (Faker $faker) {
    return [
        'attribute_id' => function () {
            return factory(App\Catalog\Product\Attribute::class)->create()->id;
        },
        'value' => $faker->text,
    ];
});
