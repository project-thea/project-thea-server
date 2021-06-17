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
                'name' => 'Edgar Jessy',
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
                'name' => 'Rogers Douglas',
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
                'name' => 'Cathy Ankunda',
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
                'name' => 'Josephine Ankunda',
                'email' => 'josy@gmail.com',
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
                'name' => 'Edwin Kay',
                'email' => 'edy@gmail.com',
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
                'name' => 'Doreen Jules',
                'email' => 'jules@gmail.com',
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
                'name' => 'Daniel Irish',
                'email' => 'dan@gmail.com',
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
                'name' => 'Miguel Danze',
                'email' => 'danze@gmail.com',
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
                'name' => 'Fred Barungi',
                'email' => 'barungi@gmail.com',
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
                'name' => 'Charles Mwezi',
                'email' => 'mwezi@gmail.com',
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
                'name' => 'Sufficient Lagu',
                'email' => 'lagu@gmail.com',
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
                'name' => 'Jude Kats',
                'email' => 'jude@gmail.com',
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
                'name' => 'Gaetano Kaggwa',
                'email' => 'kaggwa@gmail.com',
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
