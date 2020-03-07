<?php

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Faker\Factory;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Blog::class,20)->create();
    }
}
