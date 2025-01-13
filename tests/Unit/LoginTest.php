<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginTest extends TestCase
{

    /**
     * Test successful login.
     *
     * @return void
     */
    public function test_successful_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User logged in successfully.',
                'data' => [
                    'name' => $user->name,
                ],
            ]);

        $this->assertArrayHasKey('token', $response->json('data'));
        $user->delete();
    }

    /**
     * Test unsuccessful login.
     *
     * @return void
     */
    public function test_unsuccessful_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'Unauthorised.',
                'data' => [
                    'error' => 'Unauthorised',
                ],
            ]);
        
        $user->delete();
    }
}