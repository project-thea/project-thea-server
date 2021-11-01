<?php

namespace Database\Seeders;

use App\Models\Response;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ResponsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $responses = [
            [
                'questionnaire_id' => '1',
                'data' => '{
                    "2": {
                        "value": "2021-10-28",
                        "dataType": "date"
                    },
                    "10": {
                        "value": "I have no idea",
                        "dataType": "text"
                    },
                    "11": {
                        "value": true,
                        "dataType": "radio button"
                    },
                    "12": {
                        "value": true,
                        "dataType": "checkbox"
                    },
                    "13": {
                        "value": "13:30",
                        "dataType": "time"
                    },
                    "14": {
                        "value": "2021-10-28T13:24",
                        "dataType": "datetime"
                    }
                }',
                'created_by' => '4',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'questionnaire_id' => '4',
                'data' => '{
                    "2": {
                        "value": "2021-10-28",
                        "dataType": "date"
                    },
                    "10": {
                        "value": "I expect clear responses",
                        "dataType": "text"
                    },
                    "11": {
                        "value": true,
                        "dataType": "radio button"
                    },
                    "12": {
                        "value": true,
                        "dataType": "checkbox"
                    },
                    "13": {
                        "value": "20:00",
                        "dataType": "time"
                    },
                    "14": {
                        "value": "2021-10-28T16:32",
                        "dataType": "datetime"
                    }
                }',
                'created_by' => '4',
                'updated_by' => '4',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        Response::insert($responses);
    }
}
