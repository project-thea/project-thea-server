<?php

namespace Database\Factories;

use App\Models\Test;
use App\Models\Disease;
use App\Models\Status;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Test::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'disease_id' => function () {
                return Disease::factory()->create()->id;
            },
            'subject_id' => function () {
                return Subject::factory()->create()->id;
            },
            'status_id' => function () {
                return Status::factory()->create()->id;
            },
            'test_date' => $this->faker->date(),
            'status_update_date' => $this->faker->date(),
            'created_with' => 'user',
            'updated_with' => 'app'
        ];
    }
}
