<?php

namespace Tests\Feature\Api\Auth;

use Tests\Feature\Trait\Utils;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use Utils;

    public function testFailAuth(): void
    {
        $response = $this->postJson('/api/auth', []);

        $response->assertStatus(422);
    }

    public function testAuth(): void
    {
        $user = $this->createUser();

        $response = $this->postJson('/api/auth', [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'test',
        ]);

        $response->assertStatus(200);
    }

    public function testFailRegisterUser(): void
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422);
    }

    public function testRegisterUser(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Teste',
            'email' => 'teste@test.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function testFailRegisterUserDuplicate(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Teste',
            'email' => 'teste@test.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);

        $responseDuplicate = $this->postJson('/api/register', [
            'name' => 'Teste2',
            'email' => 'teste@test.com',
            'password' => 'password',
        ]);

        $responseDuplicate->assertStatus(422);

        $responseDuplicate->assertJson([
            'message' => 'The email has already been taken.',
            'errors' => [
                'email' => ['The email has already been taken.'],
            ],
        ]);
    }

    public function testFailLogout(): void
    {
        $response = $this->postJson('/api/logout');

        $response->assertStatus(401);
    }

    public function testLogout(): void
    {
        $user = $this->defaultHeaders();

        $response = $this->postJson('/api/logout', [], $user);

        $response->assertStatus(200);
    }
}
