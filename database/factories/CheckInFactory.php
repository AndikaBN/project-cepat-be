<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CheckIn>
 */
class CheckInFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // berdasarkan banyaknya user yang ada,
            // user_id harus ada di tabel users
            'user_id' => $this->faker->numberBetween(1, 10),
            'location_id' => $this->faker->randomNumber(),
            'day' => $this->faker->date(),
            'status' => $this->faker->randomElement(['checkin', 'checkout']),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'data_otlets_id' => $this->faker->numberBetween(1, 2),
            'outlet_name' => $this->faker->word,
        ];
    }
}
