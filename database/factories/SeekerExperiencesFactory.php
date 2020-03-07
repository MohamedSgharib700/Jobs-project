<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Constants\UserTypes;
use App\Models\SeekerExperience;
use App\Models\User;
use \App\Constants\YearsExperiences;
use \App\Constants\CareerLevels;
use \App\Constants\EducationLevel;
use Carbon\Carbon;
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

$factory->define(SeekerExperience::class, function (Faker $faker) {
    $users = User::where('type', UserTypes::SEEKER)->get();
    $date = Carbon::create(2015, 5, 28, 0, 0, 0);
    return [
        'user_id'       => $faker->unique()->randomElement($users)->id,
        'years_of_experience'   => $faker->randomElement(array_keys(YearsExperiences::getList())),
        'education_level'    => $faker->randomElement(array_keys(EducationLevel::getList())),
        'previous_experience'     => $faker->jobTitle,
        'previous_experience_from_date'  => $date->format('Y-m-d H:i:s'),
        'previous_experience_to_date'  => $date->addWeeks(rand(1, 52))->format('Y-m-d H:i:s'),
        'career_level'  => $faker->randomElement(array_keys(CareerLevels::getList())),
    ];
});
