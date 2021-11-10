<?php

namespace Database\Factories;

use App\Models\DataType;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

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
            'datatype_id' => function () {
                return DataType::factory()->create()->id;
            },
            'title' => $this->faker->title,
            'attributes' => $this->generateAttributes(),
            'position' => $this->faker->numberBetween(1, 1000)
        ];
    }

    private function generateAttributes()
    {
        $attributes = [
            'default' => 'Any string',
            'format' => 'string',
            'required' => 'true',
        ];

        return json_encode($attributes);
    }
}
