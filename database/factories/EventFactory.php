<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organizer_id' => \App\Models\User::where('role', 'o')->get()->random()->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'category_id' => \App\Models\Category::all()->random()->id,
            'start_date' => $this->faker->dateTime,
            'end_date' => $this->faker->dateTime,
            'location' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'max_attendees' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
