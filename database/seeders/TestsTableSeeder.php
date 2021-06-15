<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->insert([
            [
                'disease_id' => '1',
                'subject_id' => '2',
                'test_date' => '2020-09-16',
                'status' => 'Negative',
                'status_update_date' => '2020-09-20',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'disease_id' => '3',
                'subject_id' => '2',
                'test_date' => '2020-08-15',
                'status' => 'Positive',
                'status_update_date' => '2020-08-19',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'disease_id' => '2',
                'subject_id' => '3',
                'test_date' => '2020-06-14',
                'status' => 'Unknown',
                'status_update_date' => '2020-06-15',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '3',
                'updated_by' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
