<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hospital;
use Faker\Generator as Faker;

$factory->define(Hospital::class, function (Faker $faker) {
    $title = $faker->randomElement([
        'Dr. ','Prof. ', 'dr. '
    ]);
    $fn = $faker->firstName;
    $ln = $faker->lastName;

    $name = $title . $fn . ' ' . $ln;

    $email = $faker->randomElement([
        'admin@', 'call@', 'hallo@',
        'hai@', 'cs@', 'host@', 'me@'
    ]) . strtolower($fn.$ln) . $faker->randomElement([
        '.com','.id','.org',
        '.co.id','.go.id',
    ]);

    return [
        'name' => $name,
        'email' => $email,
        'address' => $faker->address,
        'phone' => $faker->e164PhoneNumber,
    ];
});
