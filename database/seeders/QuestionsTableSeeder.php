<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'questionnaire_id' => '1',
                'datatype_id' => '2',
                'title' => 'How much time does it take from the border to Elegu town',
                'attributes' => '{
                    "format": "14:54:21",
                    "required": "true"
                }',
                'position' => '2',
                'created_by' => '2',
                'updated_by' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'questionnaire_id' => '2',
                'datatype_id' => '1',
                'title' => 'Which date was recorded for the tracking from the border to Elegu town',
                'attributes' => '{
                    "format": "2021-08-25",
                    "required": "true"
                }',
                'position' => '1',
                'created_by' => '1',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ], 

            [
                'questionnaire_id' => '3',
                'datatype_id' => '4',
                'title' => 'What is your gender',
                'attributes' => '{
                    "required": "true"
                }',
                'position' => '3',
                'created_by' => '1',
                'updated_by' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'questionnaire_id' => '4',
                'datatype_id' => '3',
                'title' => 'When was tracking done and at what time was it recorded',
                'attributes' => '{
                    "format": "2021-08-25 15:54:21",
                    "required": "true"
                }',
                'position' => '4',
                'created_by' => '2',
                'updated_by' => '3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        Question::insert($questions);
    }
}
