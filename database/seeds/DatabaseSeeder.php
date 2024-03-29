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
        $this->call(CategorySeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(CampusSeeder::class);
        $this->call(TagsSeeder::class);
    }
}
