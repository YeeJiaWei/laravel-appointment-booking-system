<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\BusinessOwner>
 */
class BusinessOwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        while (true) {
            // Replace '.' to 'a' character in default faker username
            $username = str_replace(".", "a", fake()->userName());

            // Generate usernames that are 6 or more characters long
            if (strlen($username) >= 6) {
                break;
            }
        }

        return [
            'business_name' => fake()->company(),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'username' => $username,
            'password' => bcrypt(fake()->password()),
            'address' => fake()->streetAddress(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
