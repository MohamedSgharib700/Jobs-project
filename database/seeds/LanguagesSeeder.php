<?php

use App\Models\Language;
use Faker\Factory;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Language::class, 10)->create();
    }
}
