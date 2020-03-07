<?php

use App\Models\Industry;
use Faker\Factory;
use Illuminate\Database\Seeder;

class IndustriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Industry::class, 10)->create(['parent_id' => null]);
        factory(Industry::class, 20)->create();
    }
}
