<?php

use App\Models\Log;
use App\Models\User;
use App\Constants\ObjectTypes as ObjectTypes;

use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Log::class, function (Faker $faker) {

    $user = User::query()->inRandomOrder()->first();

    $logs = [
        'user_id' => $user->id,
        'object_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]),
        'object_type' => $faker->randomElement(ObjectTypes::getKeyList()),
        'message' => $faker->text(25),
    ];

    return $logs;
});