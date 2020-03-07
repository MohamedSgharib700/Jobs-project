<?php

use App\Models\Blog;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    $arabicFaker = Factory::create('ar_SA');

    $blog = [
        'image' => '/assets/web/img/story_1.jpg',
        'active'    => $faker->boolean,
        'link'    => $faker->url,
    
    ];
    foreach (Config::get('app.locales') as $lang => $language) {
        $faker = $lang == 'ar' ? $arabicFaker : $faker;
        $blog[$lang] = [
            'name'    => $faker->name,
            'description'    => $faker->text,
        ];
    }
    return $blog;
});


