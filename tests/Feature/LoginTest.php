<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
     /** @test */
     public function a_visitor_can_able_to_login()
     {
        $user = (new User())->find(1);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);

     }
}
