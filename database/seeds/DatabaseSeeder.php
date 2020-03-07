<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SkillsSeeder::class);
        $this->call(LanguagesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(LocationsSeeder::class);
        $this->call(IndustriesSeeder::class);
        $this->call(LogsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EmployerDetailsSeeder::class);
        $this->call(SeekerDetailsSeeder::class);
        $this->call(SeekerExperiencesSeeder::class);
        $this->call(AgenciesSeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(UserGroupsSeeder::class);
        $this->call(GroupPermissionsSeeder::class);
        $this->call(BlogSeeder::class);
    }
}
