<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\Group;
use Faker\Factory;

class GroupsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Group::class)->create([
            'active' => true,
            'en'=> ['name' => 'Super Admin'],
            'ar'=> ['name' => 'مدير']
        ]);
        $groups = factory(Group::class, 10)->create();
    }
}
