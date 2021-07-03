<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

            [
                'first_name' => 'Benz',
                'last_name' => 'Natukunda',
                'email' => 'benz@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1991-04-18',
                'phone' => '0773894676',
                'next_of_kin' => 'Andrew Buwembo',
                'next_of_kin_phone' => '0753578647',
                'unique_id' => '7e57d004-2b97-0e7a-Q35f-5387367791cd',
                'id_number' => 'CM91918563K7865',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '1',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Innocent',
                'last_name' => 'Bwogi',
                'email' => 'bwogi@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1989-04-18',
                'phone' => '0773854676',
                'next_of_kin' => 'Kinsley Bugabi',
                'next_of_kin_phone' => '0753578647',
                'unique_id' => '7e57d844-2b97-0e7a-Q75f-5387367791cd',
                'id_number' => 'CM91918J53K7865',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '1',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Ibrahim',
                'last_name' => 'Nganda',
                'email' => 'nganda@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1988-06-13',
                'phone' => '0773454676',
                'next_of_kin' => 'Kinsley Bugabi',
                'next_of_kin_phone' => '0753578647',
                'unique_id' => '7e57d844-2b97-0e7a-Q98f-5387367791cd',
                'id_number' => 'CM91918J53K78W2',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '1',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Prossy',
                'last_name' => 'Musinguzi',
                'email' => 'prossy@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1992-02-13',
                'phone' => '0772164676',
                'next_of_kin' => 'Kinsley Muhumuza',
                'next_of_kin_phone' => '0753578690',
                'unique_id' => '7e57d844-2b97-0e7b-Q98f-5387367791cd',
                'id_number' => 'CF78918G53K78W2',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '1',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Jamila',
                'last_name' => 'Kaweesi',
                'email' => 'kaweesi@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1985-01-19',
                'phone' => '0772164674',
                'next_of_kin' => 'Benson Muhumuza',
                'next_of_kin_phone' => '0753578690',
                'unique_id' => '7e57d933-2b97-0e7b-Q98f-5387367791cd',
                'id_number' => 'CF78918G53K78W2',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Ndugu',
                'last_name' => 'Muhoozi',
                'email' => 'muhoozi@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1993-08-05',
                'phone' => '0776164674',
                'next_of_kin' => 'Benson Tinye',
                'next_of_kin_phone' => '0753578697',
                'unique_id' => '7e57d933-2b97-He7b-Q98f-5387367791cd',
                'id_number' => 'CF78J18G53K78W2',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Isaac',
                'last_name' => 'Noah',
                'email' => 'noah@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1993-04-23',
                'phone' => '0773165874',
                'next_of_kin' => 'Madhivan Musoke',
                'next_of_kin_phone' => '0753578639',
                'unique_id' => '7eH5d933-2b97-He7b-Q98f-5387367791cd',
                'id_number' => 'CF9PJ18G53K78W2',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Douglas',
                'last_name' => 'Kasuku',
                'email' => 'kasuku@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1988-01-29',
                'phone' => '0773255874',
                'next_of_kin' => 'Madhivan Kangave',
                'next_of_kin_phone' => '0753578639',
                'unique_id' => '7eH5d933-2b97-He7b-Q98f-5387367791cd',
                'id_number' => 'CF9PJ18G53K78W2',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '8',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'first_name' => 'Victor',
                'last_name' => 'Basiima',
                'email' => 'basiima@gmail.com',
                'nationality' => 'Ugandan',
                'date_of_birth' => '1992-08-15',
                'phone' => '0773255882',
                'next_of_kin' => 'Bryan Onyango',
                'next_of_kin_phone' => '0753578639',
                'unique_id' => '7eH5d933-2b97-He7b-Q98f-5387367791cd',
                'id_number' => 'CF9PJ18G53K78W2',
                'id_type' => 'National ID',
                'created_with' => 'app',
                'updated_with' => 'app',
                'created_by' => '3',
                'updated_by' => '7',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
