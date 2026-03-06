<?php

use App\Models\Service;

test('home page returns successful response', function () {
    Service::factory()->count(2)->create();

    $response = $this->get('/');

    $response->assertOk()
             ->assertViewIs('reservations.index')
             ->assertViewHas('accommodations');
});

test('home page displays services', function () {
    $service = Service::factory()->create(['name' => 'Beach Hotel']);

    $response = $this->get('/');

    $response->assertOk()
             ->assertSee('Beach Hotel');
});
