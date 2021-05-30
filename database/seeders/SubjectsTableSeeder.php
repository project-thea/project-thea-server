<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                'first_name' => 'Edgar',
                'middle_name' => 'Jessy',
                'last_name' => 'Salsay',
                'email' => 'edgar@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1987-09-21',
                'phone' => '0773784676',
                'next_of_kin' => 'Andrew Kabuura',
                'next_of_kin_phone' => '0753578647',
                'unique_id' => '7e57d004-2b97-0e7a-b45f-5387367791cd',
                'id_number' => 'CM92017563K7865',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '1',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Rogers',
                'middle_name' => 'Ole',
                'last_name' => 'Douglas',
                'email' => 'rogers@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1987-04-26',
                'phone' => '0773784676',
                'next_of_kin' => 'Andrew Kabuura',
                'next_of_kin_phone' => '0753578647',
                'unique_id' => '7e57d004-2b97-0e7a-D45f-5387367791cd',
                'id_number' => 'CF92019563K7865',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Cathy',
                'middle_name' => 'Jessica',
                'last_name' => 'Ankunda',
                'email' => 'jessica@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1991-09-21',
                'phone' => '0773784676',
                'next_of_kin' => 'Andrew Kakembo',
                'next_of_kin_phone' => '0753578647',
                'unique_id' => '7e57d004-2b97-0e7a-Q75f-5387367791cd',
                'id_number' => 'CM91918563K7865',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
