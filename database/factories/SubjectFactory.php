<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nationality' => $this->faker->country,
            'date_of_birth' => $this->faker->date,
            'phone' => $this->faker->phoneNumber,
            'next_of_kin' => $this->faker->name(),
            'next_of_kin_phone' => $this->faker->phoneNumber,
            'unique_id' => $this->faker->uuid,
            'id_number' => $this->faker->bothify(),
            'id_type' => 'National ID',
        ];
    }
}
