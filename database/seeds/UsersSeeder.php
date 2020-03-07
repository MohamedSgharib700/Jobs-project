<?php

use App\Constants\UserTypes;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@lodex.com',
            'password' =>'102030',
            'active' => true,
            'type' => UserTypes::ADMIN
        ]);
        factory(User::class, 20)->create();
    }
}
