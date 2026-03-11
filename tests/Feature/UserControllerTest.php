<?php

use App\Models\User;

test('register page returns successful response', function () {
    $response = $this->get('/register');

    $response->assertOk()
             ->assertViewIs('auth.register');
});

test('login page returns successful response', function () {
    $response = $this->get('/login');

    $response->assertOk()
             ->assertViewIs('auth.login');
});

test('store user with valid data', function () {
    $response = $this->post('/register', [
        'name'                  => 'John Doe',
        'email'                 => 'john@example.com',
        'password'              => 'secret1234',
        'password_confirmation' => 'secret1234',
        'role'                  => 'customer',
    ]);

    $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
});

test('store user fails with invalid data', function () {
    $response = $this->post('/register', []);

    $response->assertSessionHasErrors(['name', 'email', 'role']);
});

test('login with valid credentials redirects to home', function () {
    User::factory()->create([
        'email'    => 'user@test.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/login', [
        'email'    => 'user@test.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('home'));
    $this->assertAuthenticated();
});

test('login with invalid credentials returns validation errors', function () {
    User::factory()->create([
        'email'    => 'user@test.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/login', [
        'email'    => 'user@test.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors(['email']);
    $this->assertGuest();
});

test('profile page requires authentication', function () {
    $response = $this->get('/profile');

    $response->assertRedirect(route('login'));
});

test('profile page is accessible when authenticated', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/profile');

    $response->assertOk()
             ->assertViewIs('auth.profile')
             ->assertViewHas('user');
});

test('update profile with valid data', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->patch('/profile', [
        'name'  => 'Updated Name',
        'email' => $user->email,
        'role'  => $user->role,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'id'   => $user->id,
        'name' => 'Updated Name',
    ]);
});
