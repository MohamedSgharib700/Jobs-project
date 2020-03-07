<?php

use App\Models\EmployerDetails;
use Illuminate\Database\Seeder;
use Faker\Factory;

class EmployerDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EmployerDetails::class,5)->create();
    }
}
