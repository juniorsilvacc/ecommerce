<?php

namespace Tests\Feature\Trait;

use App\Models\User;

trait Utils
{
    /**
     * A basic feature test example.
     */
    public function createUser()
    {
        $user = User::factory()->create();

        return $user;
    }

    public function createTokenUser()
    {
        $user = $this->createUser();

        $token = $user->createToken('teste')->plainTextToken;

        return $token;
    }

    public function defaultHeaders()
    {
        $token = $this->createTokenUser();

        return [
            'Authorization' => "Bearer {$token}",
        ];
    }
}
