<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SeekerDetails;
use App\Models\User;
use \App\Constants\MilitaryStatus;
use \App\Constants\UserTypes;
use \App\Constants\MaritalStatus;
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

$factory->define(SeekerDetails::class, function (Faker $faker) {
    $users = User::where('type', UserTypes::SEEKER)->get();
    return [
        'user_id'       => $faker->unique()->randomElement($users)->id,
        'marital_status'   => $faker->randomElement(array_keys(MaritalStatus::getList())),
        'military_status'    => $faker->randomElement(array_keys(MilitaryStatus::getList())),
        'social_account'  => $faker->word,
    ];
});
