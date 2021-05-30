<?php

use Database\Seeders\DiseasesTableSeeder;
use Database\Seeders\SubjectsTableSeeder;
use Database\Seeders\TestsTableSeeder;
use Database\Seeders\UsersTableSeeder;
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
        $this->call([
            UsersTableSeeder::class,
            SubjectsTableSeeder::class,
            DiseasesTableSeeder::class,
            TestsTableSeeder::class
        ]);
    }
}
