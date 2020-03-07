<?php

use App\Models\Industry;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Industry::class, function (Faker $faker) {
    $arabicFaker = Factory::create('ar_SA');
    $industries = Industry::whereRaw('(`_lft`+1)', '`_rgt`')->get();
    $industry = [
        'image' => $faker->imageUrl(),
        'active'    => $faker->boolean,
        'parent_id' => $industries->isEmpty()? null : $faker->randomElement($industries)->id
    ];
    foreach (Config::get('app.locales') as $lang => $language) {
        $faker = $lang == 'ar' ? $arabicFaker : $faker;
        $industry[$lang] = [
            'name'    => $faker->name,
        ];
    }
    return $industry;
});


