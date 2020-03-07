<?php

use App\Models\Skill;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Skill::class, function (Faker $faker) {

    $skills = [
        'title' => $faker->word
    ];

    return $skills;
});


