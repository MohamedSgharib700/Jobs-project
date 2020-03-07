<?php

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Location::class, 3)->create(['parent_id' => null]);
        factory(Location::class, 10)->create();
    }
}
