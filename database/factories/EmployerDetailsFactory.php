<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use App\Models\EmployerDetails;
use App\Models\Industry;
use \App\Constants\UserTypes;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(EmployerDetails::class, function (Faker $faker) {
    $users      = User::where('type', UserTypes::OWNER)->get();
    $industries = Industry::where('active', '=', '1')->get();
    return [
        'user_id'       => $faker->unique()->randomElement($users)->id,
        'industry_id'   => $faker->randomElement($industries)->id,
        'location_id'    => $faker->randomElement([1, 2]),
        'company_name'  => $faker->name,
        'company_size'  => $faker->randomElement([1, 2, 3, 4]),
        'job_title'     => $faker->jobTitle,
        'active'         => $faker->boolean,


    ];

});
