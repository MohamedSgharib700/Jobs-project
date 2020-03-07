<?php

use App\Models\Agency;
use App\Models\Location;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Agency::class, function (Faker $faker) {
    $country_id = Location::where('parent_id',null)->get();
    $location_id = Location::where('parent_id','>',0)->get();
$phone="123456789";
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' =>'010' . substr(str_shuffle($phone), 1, 9) ,
        'long' =>$faker->randomFloat(2, 0, 100),
        'lat' => $faker->randomFloat(2, 0, 100),
        'location_id' => $faker->randomElement( $location_id)->id,
        'address' =>$faker->text(25),
        'active' =>$faker->boolean,
    ];
});
