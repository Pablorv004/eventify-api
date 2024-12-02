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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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
    }
}
