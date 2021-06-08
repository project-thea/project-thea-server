<?php

use Database\Seeders\DiseasesTableSeeder;
use Database\Seeders\SampleTestTrackingTableSeeder;
use Database\Seeders\SampleTrackingTableSeeder;
use Database\Seeders\SubjectsTableSeeder;
use Database\Seeders\SubjectTrackingTableSeeder;
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
            TestsTableSeeder::class,
            SubjectTrackingTableSeeder::class,
            SampleTrackingTableSeeder::class,
            SampleTestTrackingTableSeeder::class
        ]);
    }
}
