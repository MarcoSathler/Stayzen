<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('register creates a new user', function () {
    $response = $this->postJson('/api/auth/register', [
        'name'                  => 'John Doe',
        'email'                 => 'john@example.com',
        'password'              => 'secret12345',
        'password_confirmation' => 'secret12345',
        'role'                  => 'customer',
    ]);

    $response->assertStatus(201)
             ->assertJsonStructure(['user' => ['id', 'name', 'email']]);

    $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
});

test('register fails with missing fields', function () {
    $response = $this->postJson('/api/auth/register', []);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['name', 'email', 'role']);
});

test('register fails with invalid role', function () {
    $response = $this->postJson('/api/auth/register', [
        'name'     => 'Jane',
        'email'    => 'jane@example.com',
        'password' => 'secret123',
        'role'     => 'superadmin',
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['role']);
});

test('login returns a token with valid credentials', function () {
    User::factory()->create([
        'email'    => 'user@test.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/auth/login', [
        'email'    => 'user@test.com',
        'password' => 'password123',
    ]);

    $response->assertOk()
             ->assertJsonStructure(['user', 'token', 'token_type']);
});

test('login fails with wrong password', function () {
    User::factory()->create([
        'email'    => 'user@test.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/auth/login', [
        'email'    => 'user@test.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertStatus(422);
});

test('login fails with missing fields', function () {
    $response = $this->postJson('/api/auth/login', []);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['email', 'password']);
});

test('authenticated user can get their info', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->getJson('/api/auth/me');

    $response->assertOk()
             ->assertJsonFragment(['email' => $user->email]);
});

test('unauthenticated user cannot get /me', function () {
    $response = $this->getJson('/api/auth/me');

    $response->assertUnauthorized();
});

test('authenticated user can logout', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->postJson('/api/auth/logout');

    $response->assertOk()
             ->assertJsonFragment(['message' => 'Logout done']);
});
