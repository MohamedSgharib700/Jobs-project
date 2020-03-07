<?php

use App\Models\Location;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    $arabicFaker = Factory::create('ar_SA');
    $locations = Location::whereRaw('(`_lft`+1)', '`_rgt`')->get();
    $location =  [
        'active' => $faker->boolean,
        'code' => '+20',
        'parent_id' => $locations->isEmpty()? null : $faker->randomElement($locations)->id
    ];

    foreach (Config::get('app.locales') as $lang => $language) {
        $faker = $lang == 'ar' ? $arabicFaker : $faker;
        $location[$lang] = [
            'name'    => $faker->city,
        ];
    }

    return $location;
});
