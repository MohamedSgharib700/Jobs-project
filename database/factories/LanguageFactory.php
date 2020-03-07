<?php

use App\Models\Language;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Language::class, function (Faker $faker) {
    $arabicFaker = Factory::create('ar_SA');
    $languages = [
        'active' => $faker->boolean
    ];

    foreach (Config::get('app.locales') as $lang => $language) {
        $faker = $lang == 'ar' ? $arabicFaker : $faker;
        $languages[$lang] = [
            'name'    => $faker->word,
        ];
    }

    return $languages;
});
