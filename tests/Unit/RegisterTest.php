<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\API\RegisterController;


class RegisterTest extends TestCase
{

    /**
     * Test successful registration.
     */
    public function test_register_success(): void
    {
        $request = Request::create('/api/register', 'POST', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'c_password' => 'password',
            'role' => 'user',
        ]);

        $controller = new RegisterController();
        $response = $controller->register($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $responseData = $response->getData(true);

        $this->assertTrue($responseData['success']);
        $this->assertEquals('User register successfully.', $responseData['message']);
        $this->assertArrayHasKey('token', $responseData['data']);
        $this->assertEquals('Test User', $responseData['data']['name']);
    }

    /**
     * Test registration with validation errors.
     */
    public function test_register_validation_error(): void
    {
        $request = Request::create('/api/register', 'POST', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'password',
            'c_password' => 'different_password',
            'role' => '',
        ]);

        $controller = new RegisterController();
        $response = $controller->register($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $responseData = $response->getData(true);

        $this->assertFalse($responseData['success']);
        $this->assertEquals('Validation Error.', $responseData['message']);
        $this->assertArrayHasKey('data', $responseData);
    }
}