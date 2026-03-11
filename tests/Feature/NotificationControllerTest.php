<?php

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

test('notifications index requires authentication', function () {
    $response = $this->get('/notifications');

    $response->assertRedirect(route('login'));
});

test('notifications index shows user notifications', function () {
    $user = User::factory()->create();

    // Create a database notification manually
    DatabaseNotification::create([
        'id'              => \Illuminate\Support\Str::uuid()->toString(),
        'type'            => 'App\Notifications\TestNotification',
        'notifiable_type' => 'App\Models\User',
        'notifiable_id'   => $user->id,
        'data'            => json_encode(['message' => 'Test notification']),
        'read_at'         => null,
    ]);

    $response = $this->actingAs($user)->get('/notifications');

    $response->assertOk()
             ->assertViewIs('notifications.index')
             ->assertViewHas('notifications');
});

test('mark notification as read', function () {
    $user = User::factory()->create();

    $notification = DatabaseNotification::create([
        'id'              => \Illuminate\Support\Str::uuid()->toString(),
        'type'            => 'App\Notifications\TestNotification',
        'notifiable_type' => 'App\Models\User',
        'notifiable_id'   => $user->id,
        'data'            => json_encode(['message' => 'Test notification']),
        'read_at'         => null,
    ]);

    $response = $this->actingAs($user)->post("/notifications/{$notification->id}/read");

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $notification->refresh();
    expect($notification->read_at)->not->toBeNull();
});

test('mark notification as read requires authentication', function () {
    $response = $this->post('/notifications/fake-uuid/read');

    $response->assertRedirect(route('login'));
});
