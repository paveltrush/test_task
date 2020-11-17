<?php

namespace Tests\Feature\App\Http\Controllers\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterController extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRequiresEmailAndPassword()
    {
        $this->json('POST', 'api/register')
            ->assertStatus(422)
            ->assertJson([
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }

    public function testsRegistersSuccessfully()
    {
        $user = [
            'email' => 'borgan@gmail.com',
            'password' => 'pass1234'
        ];

        $this->json('post', 'api/register', $user)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                ],
                'message' => "You are registered successfully"
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRequiresEmail()
    {
        $user = [
            'email' => 'borgan@gmail.com'
        ];

        $this->json('POST', 'api/register', $user)
            ->assertStatus(422)
            ->assertJson([
                'email' => ['The email field is required.']
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRequiresPassword()
    {
        $user = [
            'password' => 'pass1234'
        ];

        $this->json('POST', 'api/register', $user)
            ->assertStatus(422)
            ->assertJson([
                'password' => ['The password field is required.']
            ]);
    }
}
