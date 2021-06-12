<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\SubjectTracking;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectTrackingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubjectTracking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject_id' => function () {
                return Subject::factory()->create()->id;
            },
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'unique_id' => $this->faker->uuid,
            'date_time' => $this->faker->dateTime
        ];
    }
}
