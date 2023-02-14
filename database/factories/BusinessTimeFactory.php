<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\BusinessTime>
 */
class BusinessTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'day' => 'MONDAY',
            'start_time' => '06:00:00',
            'end_time' => '17:00:00',
        ];
    }
}
