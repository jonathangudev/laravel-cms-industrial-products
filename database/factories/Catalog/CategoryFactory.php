<?php

use Faker\Generator as Faker;

$factory->define(App\Catalog\Category::class, function (Faker $faker) {
    return [
        'name' => $this->faker->words(2, true),
        'company_id' => function () {
            return factory(App\Company::class)->create()->id;
        },
    ];
});
