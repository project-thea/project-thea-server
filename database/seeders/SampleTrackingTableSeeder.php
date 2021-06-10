<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SampleTrackingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sample_trackings')->insert([
            [
                'latitude' => '-2.108899',
                'longitude' => '32.818551',
                'unique_id' => '7e57d004-2b97-0e7a-D45f-5387367791cd',
                'date_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => '1',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'latitude' => '1.054628',
                'longitude' => '32.197194',
                'unique_id' => '7e57d004-2b97-0e7a-D65f-5387367791cd',
                'date_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => '1',
                'updated_by' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

            [
                'latitude' => '2.547988',
                'longitude' => '33.608686',
                'unique_id' => '7e57d004-2b97-0f7a-D45f-5387367791cd',
                'date_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => '1',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
