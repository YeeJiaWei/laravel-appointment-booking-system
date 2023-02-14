<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Get time now
        $now = Carbon::now('Australia/Melbourne');

        // Give a random day
        $days = rand(0, 365);

        // Set future or past booking by one year
        if (rand(0, 1) == 1) {
            $now->subYears(1);
        }

        // Add a random amount of days
        $now->addDays($days);

        // Convert day to Date string
        $date = $now->toDateString();

        return [
            'customer_id' => \App\Models\Customer::factory()->create()->id,
            'employee_id' => \App\Models\Employee::factory()->create()->id,
            'activity_id' => \App\Models\Activity::factory()->create()->id,
            'start_time' => '10:00:00',
            'end_time' => '13:00:00',
            'date' => $date,
        ];
    }
}
