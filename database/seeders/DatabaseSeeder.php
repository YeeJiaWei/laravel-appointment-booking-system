<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Carbon\Carbon as Time;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\BusinessOwner::factory()->create([
            'business_name' => 'John\'s Car Service',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'username' => 'john123',
            'password' => bcrypt('Password123'),
            'address' => '1 Swan Street',
            'phone' => '8382032932'
        ]);

        \App\Models\Customer::factory()->create([
            'username' => 'john1233',
            'password' => bcrypt('Password123'),
        ]);

        // 4 customers
        $customers = \App\Models\Customer::factory(4)->create();

        // Employees
        $employees = \App\Models\Employee::factory(5)->create([
            'title' => 'Mechanic'
        ]);

        \App\Models\Employee::factory()->create([
            'title' => 'Engineer'
        ]);

        \App\Models\Employee::factory()->create([
            'title' => 'Reception'
        ]);

        // Create a working timestamps
        for ($i = 0; $i < 5; $i++) {
            \App\Models\WorkingTime::create([
                'employee_id' => $employees[0]->id,
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'date' => Time::now()->endOfMonth()->subDays($i)->toDateString()
            ]);

            \App\Models\WorkingTime::create([
                'employee_id' => $employees[1]->id,
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'date' => Time::now()->startOfMonth()->addDays($i)->toDateString()
            ]);

            \App\Models\WorkingTime::create([
                'employee_id' => $employees[2]->id,
                'start_time' => '10:00:00',
                'end_time' => '17:00:00',
                'date' => Time::now()->startOfMonth()->addDays($i)->toDateString()
            ]);

            \App\Models\WorkingTime::create([
                'employee_id' => $employees[3]->id,
                'start_time' => '13:00:00',
                'end_time' => '17:00:00',
                'date' => Time::now()->startOfMonth()->addDays($i)->toDateString()
            ]);

            \App\Models\WorkingTime::create([
                'employee_id' => $employees[4]->id,
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'date' => Time::now()->startOfMonth()->addWeeks(2)->addDays($i)->toDateString()
            ]);

            // \App\Models\WorkingTime::create([
            //     'employee_id' => $employees[2]->id,
            //     'start_time' => '09:00:00',
            //     'end_time' => '17:00:00',
            //     'date' => Time::now()->startOfMonth()->addWeek(3)->addDays($i)->toDateString()
            // ]);
        }

        // Activities
        $activityOne = \App\Models\Activity::factory()->create([
            'name' => 'Oil Service',
            'duration' => '00:30'
        ]);
        $activityTwo = \App\Models\Activity::factory()->create([
            'name' => 'Smash Repair',
            'duration' => '06:00'
        ]);
        $activityThree = \App\Models\Activity::factory()->create([
            'name' => 'Full Service',
            'duration' => '08:00'
        ]);
        $activityFour = \App\Models\Activity::factory()->create([
            'name' => 'Car Radio Installation',
            'duration' => '03:00'
        ]);

        // Create Booking
        \App\Models\Booking::create([
            'customer_id' => $customers[0]->id,
            'employee_id' => $employees[0]->id,
            'activity_id' => $activityOne->id,
            'start_time' => Time::parse('11:00')->toTimeString(),
            'end_time' => \App\Models\Booking::calcEndTime($activityOne->duration, '11:00'),
            'date' => Time::now()->addDay()->toDateString()
        ]);

        \App\Models\Booking::create([
            'customer_id' => $customers[2]->id,
            'employee_id' => $employees[1]->id,
            'activity_id' => $activityOne->id,
            'start_time' => Time::parse('11:30')->toTimeString(),
            'end_time' => \App\Models\Booking::calcEndTime($activityOne->duration, '11:30'),
            'date' => Time::now()->addDays(2)->toDateString()
        ]);

        \App\Models\Booking::create([
            'customer_id' => $customers[2]->id,
            'employee_id' => $employees[3]->id,
            'activity_id' => $activityOne->id,
            'start_time' => Time::parse('10:30')->toTimeString(),
            'end_time' => \App\Models\Booking::calcEndTime($activityOne->duration, '10:30'),
            'date' => Time::now()->subDays(2)->toDateString()
        ]);

        \App\Models\Booking::create([
            'customer_id' => $customers[3]->id,
            'employee_id' => $employees[1]->id,
            'activity_id' => $activityTwo->id,
            'start_time' => Time::parse('12:30')->toTimeString(),
            'end_time' => \App\Models\Booking::calcEndTime($activityTwo->duration, '12:30'),
            'date' => Time::now()->subDays(2)->toDateString()
        ]);

        \App\Models\Booking::create([
            'customer_id' => $customers[3]->id,
            'employee_id' => $employees[0]->id,
            'activity_id' => $activityTwo->id,
            'start_time' => Time::parse('09:30')->toTimeString(),
            'end_time' => \App\Models\Booking::calcEndTime($activityTwo->duration, '09:30'),
            'date' => Time::now()->startOfMonth()->toDateString()
        ]);

        \App\Models\Booking::create([
            'customer_id' => $customers[3]->id,
            'employee_id' => $employees[3]->id,
            'activity_id' => $activityTwo->id,
            'start_time' => Time::parse('12:30')->toTimeString(),
            'end_time' => \App\Models\Booking::calcEndTime($activityTwo->duration, '12:30'),
            'date' => Time::now()->endOfMonth()->toDateString()
        ]);

        // Create business hours
        \App\Models\BusinessTime::create([
            'start_time' => '08:00:00',
            'end_time' => '17:00:00',
            'day' => 'MONDAY',
        ]);

        \App\Models\BusinessTime::create([
            'start_time' => '08:00:00',
            'end_time' => '17:00:00',
            'day' => 'TUESDAY',
        ]);

        \App\Models\BusinessTime::create([
            'start_time' => '08:00:00',
            'end_time' => '17:00:00',
            'day' => 'WEDNESDAY',
        ]);

        \App\Models\BusinessTime::create([
            'start_time' => '12:00:00',
            'end_time' => '17:00:00',
            'day' => 'SATURDAY',
        ]);
    }
}
