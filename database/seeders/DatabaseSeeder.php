<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory(7)->create(
            [
                'role' => 'u',
                'email_verified_at' => now(),
                'email_confirmed' => true,
                'activated' => random_int(0, 1),
            ]
        );

        \App\Models\User::factory(1)->create(
            [
                'role' => 'o',
                'email_verified_at' => now(),
                'email_confirmed' => true,
                'activated' => random_int(0, 1),
            ]
        );

        \App\Models\User::factory(1)->create(
            [
                'email' => 'user@user.com',
                'password' => '12345678',
                'role' => 'u',
                'email_verified_at' => now(),
                'email_confirmed' => true,
                'activated' => 1,
            ]
        );

        \App\Models\User::factory()->create(
            [
                'email' => 'organizer@organizer.com',
                'password' => '12345678',
                'role' => 'o',
                'email_verified_at' => now(),
                'email_confirmed' => true,
                'activated' => 1,
            ]
        );

        \App\Models\Category::factory()->create(
            [
                'name' => 'Music',
                'description' => 'Unite with music. Share your taste in a unique experience.',
            ]

        );

        \App\Models\Category::factory()->create(
            [
                'name' => 'Sports',
                'description' => 'Share your passion for sports with everyone.',
            ]
        );

        \App\Models\Category::factory()->create(
            [
                'name' => 'Technology',
                'description' => 'Discuss the latest technology trends, together.',
            ]
        );

        \App\Models\Event::factory(20)->create();

        \App\Models\Event::factory(1)->create(
            [
                'title' => 'Bahia Sound',
                'description' => 'Music event at bahia sur',
                'start_date' => '2025-01-01 01:00:00',
                'end_date' => '2025-01-01 07:00:00',
                'location' => 'Bahia Sur, Cadiz',
                'category_id' => 1,
                'organizer_id' => 2,
            ]
        );

        \App\Models\Event::factory(1)->create(
            [
                'title' => 'Football match',
                'description' => 'Friendly football match',
                'start_date' => '2025-02-01 17:00:00',
                'end_date' => '2025-02-01 19:00:00',
                'location' => 'Cadiz, Cadiz',
                'category_id' => 2,
                'organizer_id' => 1,
            ]
        );

        \App\Models\Event::factory(1)->create(
            [
                'title' => 'Call of duty tournament',
                'description' => 'Friendly gaming tournament',
                'start_date' => '2025-03-06 11:00:00',
                'end_date' => '2025-03-06 13:00:00',
                'location' => 'San Fernando, Cadiz',
                'category_id' => 3,
                'organizer_id' => 2,
            ]
        );
    }
}
