<?php

use App\Models\SeekerExperience;
use Illuminate\Database\Seeder;
use Faker\Factory;

class SeekerExperiencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SeekerExperience::class,5)->create();
    }
}
