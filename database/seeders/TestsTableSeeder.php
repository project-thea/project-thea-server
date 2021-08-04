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
                'project_id' => '1',
                'subject_id' => '2',
                'test_date' => '2020-09-16',
                'status_id' => '1',
                'status_update_date' => '2020-09-20',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '3',
                'subject_id' => '2',
                'test_date' => '2020-08-15',
                'status_id' => '2',
                'status_update_date' => '2020-08-19',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '2',
                'subject_id' => '3',
                'test_date' => '2020-06-14',
                'status_id' => '3',
                'status_update_date' => '2020-06-15',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '3',
                'updated_by' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '1',
                'subject_id' => '3',
                'test_date' => '2021-03-14',
                'status_id' => '2',
                'status_update_date' => '2021-03-19',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '3',
                'updated_by' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '2',
                'subject_id' => '5',
                'test_date' => '2021-04-16',
                'status_id' => '2',
                'status_update_date' => '2021-04-21',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '3',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '1',
                'subject_id' => '6',
                'test_date' => '2021-05-01',
                'status_id' => '2',
                'status_update_date' => '2021-05-04',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '4',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '6',
                'subject_id' => '7',
                'test_date' => '2021-05-03',
                'status_id' => '1',
                'status_update_date' => '2021-05-05',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '4',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '2',
                'subject_id' => '4',
                'test_date' => '2021-05-18',
                'status_id' => '1',
                'status_update_date' => '2021-05-19',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '3',
                'updated_by' => '7',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '3',
                'subject_id' => '3',
                'test_date' => '2021-05-21',
                'status_id' => '1',
                'status_update_date' => '2021-05-22',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '3',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '3',
                'subject_id' => '5',
                'test_date' => '2021-06-03',
                'status_id' => '1',
                'status_update_date' => '2021-06-04',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '1',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '4',
                'subject_id' => '5',
                'test_date' => '2021-06-08',
                'status_id' => '1',
                'status_update_date' => '2021-06-11',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '3',
                'subject_id' => '4',
                'test_date' => '2021-06-12',
                'status_id' => '3',
                'status_update_date' => '2021-06-16',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '4',
                'subject_id' => '6',
                'test_date' => '2021-06-18',
                'status_id' => '2',
                'status_update_date' => '2021-06-21',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '3',
                'subject_id' => '4',
                'test_date' => '2021-06-18',
                'status_id' => '2',
                'status_update_date' => '2021-06-19',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '4',
                'subject_id' => '5',
                'test_date' => '2021-06-21',
                'status_id' => '2',
                'status_update_date' => '2021-06-23',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '3',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '4',
                'subject_id' => '6',
                'test_date' => '2021-06-24',
                'status_id' => '1',
                'status_update_date' => '2021-06-25',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '3',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '4',
                'subject_id' => '6',
                'test_date' => '2021-06-24',
                'status_id' => '3',
                'status_update_date' => '2021-06-26',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '4',
                'subject_id' => '6',
                'test_date' => '2021-06-24',
                'status_id' => '1',
                'status_update_date' => '2021-06-26',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '3',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '4',
                'subject_id' => '6',
                'test_date' => '2021-06-24',
                'status_id' => '3',
                'status_update_date' => '2021-06-27',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '3',
                'updated_by' => '5',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'project_id' => '4',
                'subject_id' => '6',
                'test_date' => '2021-06-24',
                'status_id' => '1',
                'status_update_date' => '2021-06-28',
                'created_with' => 'user',
                'updated_with' => 'app',
                'created_by' => '2',
                'updated_by' => '8',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
