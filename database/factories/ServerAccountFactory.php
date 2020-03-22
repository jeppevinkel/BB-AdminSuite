<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ServerAccount;
use Faker\Generator as Faker;

$factory->define(ServerAccount::class, function (Faker $faker) {
    return [
        'name' => $faker->domainName,
        'plan_level' => $faker->numberBetween(0, 4)
    ];
});
