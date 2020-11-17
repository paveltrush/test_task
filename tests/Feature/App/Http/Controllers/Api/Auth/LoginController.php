<?php

namespace Tests\Feature\App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginController extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRequiresEmailAndPassword()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }

    public function testUserLoginsFail()
    {
        User::create([
            'email' => 'borgan@gmail.com',
            'password' => 'pass1234',
        ]);

        $user = ['email' => 'testlogin@user.com', 'password' => 'toptal123'];

        $this->json('POST', 'api/login', $user)
            ->assertStatus(401);
    }

    public function testUserLoginsSuccessfully()
    {
        User::create([
            'email' => 'borgan@gmail.com',
            'password' => 'pass1234',
        ]);

        $user = ['email' => 'borgan@gmail.com', 'password' => 'pass1234'];

        $this->json('POST', 'api/login', $user)
            ->assertStatus(200)
            ->assertJsonCount(3, 'data');

    }
}
