<?php

namespace Database\Factories;

use App\Models\Questionnaire;
use App\Models\Response;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResponseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Response::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'questionnaire_id' => function () {
                return Questionnaire::factory()->create()->id;
            },
            'data' => $this->generateDataAttributes()
        ];
    }

    private function generateDataAttributes()
    {
        $data = [
            'response' => '{
                "1": {
                    "value": "One",
                    "dataType": "checkbox"
                },

                "4": {
                    "value": "2021-10-27",
                    "dataType": "date"
                },

                "5": {
                    "value": "Any text",
                    "dataType": "text"
                }
            }'
        ];

        return json_encode($data);
    }
}
