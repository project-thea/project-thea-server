<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\RiskAssessment;
use App\Models\Hotspot;
use App\Models\Test;

class RiskAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //get hotspot with strength = 1000
        $hotspot = Hotspot::where('strength', 1000)->first();

        //get test with id = 1
        $test = Test::find(1);

        $data = [
            [
                'test_id' => $test->id,
                'hotspot_id' => $hotspot->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('risk_assessment')->insert($data);

    }
}
