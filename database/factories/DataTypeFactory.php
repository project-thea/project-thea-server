<?php

namespace Database\Factories;

use App\Models\DataType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DataType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'attributes' => $this->generateAttributes()
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
