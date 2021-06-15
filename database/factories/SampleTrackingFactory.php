<?php

namespace Database\Factories;

use App\Models\SampleTracking;
use Illuminate\Database\Eloquent\Factories\Factory;

class SampleTrackingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SampleTracking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'unique_id' => $this->faker->uuid,
            'date_time' => $this->faker->dateTime
        ];
    }
}
