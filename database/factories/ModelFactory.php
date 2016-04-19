<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    $places = fopen(storage_path('data/Towns_List.csv'), 'r');

    while(!feof($places))
    {
        $place = fgetcsv($places);
        $regions[] = $place[1];
        $towns[$place[1]][] = $place[0];
    }

    fclose($places);

    $region = collect($regions)->random();
    $town = collect($towns[$region])->random();

    $genders = ['Male', 'Female'];

    return [
        'CustomerName' => $faker->name,
        'CustomerGender' => $genders[mt_rand(0,1)],
        'CustomerAge' => $faker->numberBetween(18, 80),
        'CustomerRegion' => $region,
        'CustomerTown' => $town,
        'MemberBeginDate' => $faker->dateTimeBetween('-10 years')->format('Y-m-d'),
    ];
});

$factory->define(App\Cashier::class, function (Faker\Generator $faker) {

    $genders = ['Male', 'Female'];

    return [
        'EmployeeID' => $faker->numberBetween(1000000, 9999999),
        'CashierName' => $faker->firstName . ' ' . $faker->lastName,
        'CashierAge' => $faker->numberBetween(18, 80),
        'CashierGender' => $genders[mt_rand(0,1)],
        'EmploymentStartDate' => $faker->dateTimeBetween('-25 years')->format('Y-m-d'),
    ];
});

