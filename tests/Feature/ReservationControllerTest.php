<?php

use App\Models\User;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\Reservation;

test('show accommodation requires authentication', function () {
    $service = Service::factory()->create();

    $response = $this->get("/reservations/{$service->id}");

    $response->assertRedirect(route('login'));
});

test('show accommodation details when authenticated', function () {
    $user    = User::factory()->create();
    $service = Service::factory()->create(['name' => 'Mountain Lodge']);
    ServiceImage::factory()->create(['service_id' => $service->id]);

    $response = $this->actingAs($user)->get("/reservations/{$service->id}");

    $response->assertOk()
             ->assertViewIs('reservations.show')
             ->assertViewHas('accommodation');
});

test('store reservation with valid data', function () {
    $user    = User::factory()->create();
    $service = Service::factory()->create();

    $response = $this->actingAs($user)->post("/reservations/{$service->id}", [
        'check_in'  => now()->addDays(1)->toDateString(),
        'check_out' => now()->addDays(3)->toDateString(),
    ]);

    $response->assertRedirect(route('reservations.show', $service->id));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('reservations', [
        'user_id'    => $user->id,
        'service_id' => $service->id,
        'status'     => 'pending',
    ]);
});

test('store reservation fails with missing dates', function () {
    $user    = User::factory()->create();
    $service = Service::factory()->create();

    $response = $this->actingAs($user)->post("/reservations/{$service->id}", []);

    $response->assertSessionHasErrors(['check_in', 'check_out']);
});

test('store reservation requires authentication', function () {
    $service = Service::factory()->create();

    $response = $this->post("/reservations/{$service->id}", [
        'check_in'  => now()->addDays(1)->toDateString(),
        'check_out' => now()->addDays(3)->toDateString(),
    ]);

    $response->assertRedirect(route('login'));
});

test('my reservations page shows user reservations grouped by status', function () {
    $user = User::factory()->create();

    Reservation::factory()->pending()->create(['user_id' => $user->id]);
    Reservation::factory()->confirmed()->create(['user_id' => $user->id]);
    Reservation::factory()->cancelled()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->get('/my-reservations');

    $response->assertOk()
             ->assertViewIs('reservations.my')
             ->assertViewHas('pending')
             ->assertViewHas('confirmed')
             ->assertViewHas('cancelled');
});

test('my reservations requires authentication', function () {
    $response = $this->get('/my-reservations');

    $response->assertRedirect(route('login'));
});

test('reservations index requires authentication', function () {
    $response = $this->get('/reservations');

    $response->assertRedirect(route('login'));
});
