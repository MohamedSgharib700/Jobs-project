<?php

use App\Models\SeekerDetails;
use Illuminate\Database\Seeder;
use Faker\Factory;

class SeekerDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SeekerDetails::class,5)->create();
    }
}
