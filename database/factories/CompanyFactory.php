<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
        'logo' => 'fake/220/112',
    ];
});
