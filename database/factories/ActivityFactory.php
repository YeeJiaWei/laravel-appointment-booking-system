<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $hour = rand(2, 4);
        $minute = rand(0, 1) == 1 ? 0 : 30;

        // Set duration
        $duration = Carbon::createFromTime($hour, $minute)->format('H:i');

        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'duration' => $duration,
        ];
    }
}
