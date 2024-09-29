<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function test_update_user_profile_successfully(): void
    {
        $user = User::factory()->create();

        Auth::login($user);

        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'about' => 'This is updated information about the user.'
        ];

        $response = $this->postJson('/my-profile/update', $data);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'user' => [
                    'id',
                    'name',
                    'email',
                    'about',
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'about' => $data['about'],
        ]);
    }

    public function test_update_user_profile_validation_error(): void
    {
        $user = User::factory()->create();

        Auth::login($user);

        $data = [
            'name' => '', // Name is required
            'email' => 'not-an-email', // Invalid email format
            'about' => str_repeat('a', 300), // About is too long
        ];

        $response = $this->postJson('/my-profile/update', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'about']);
    }
}
