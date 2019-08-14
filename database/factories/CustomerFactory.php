<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'id' => md5(uniqid()),
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'telephone' => $faker->phoneNumber,
        'street' => $faker->streetName,
        'streetNumber' => $faker->numerify(),
        'zipcode' => $faker->numerify('#####'),
        'city' => $faker->city,
        'accountOwner' => $faker->name,
        'iban' => $faker->iban(),
    ];
});
