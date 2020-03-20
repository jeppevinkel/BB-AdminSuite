<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Logins;
use Faker\Generator as Faker;

$factory->define(Logins::class, function (Faker $faker) {
    return [
        'password_salt' => $faker->password,
        'password_hash' => $faker->password,
        'user_id' => $faker->unique()->numberBetween(),
    ];
});
