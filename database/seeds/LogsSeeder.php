<?php

use App\Models\Log;
use Faker\Factory;
use Illuminate\Database\Seeder;

class LogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Log::class, 20)->create();
    }
}
