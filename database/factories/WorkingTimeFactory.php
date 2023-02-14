<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\WorkingTime>
 */
class WorkingTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employee_id' => \App\Models\Employee::factory()->create()->id,
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
            'date' => fake()->date(),
        ];
    }
}
