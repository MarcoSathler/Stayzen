<?php

use App\Models\Service;

test('list services returns paginated json', function () {
    Service::factory()->count(3)->create();

    $response = $this->getJson('/api/services');

    $response->assertOk()
             ->assertJsonStructure([
                 'status',
                 'data' => [
                     'data',
                     'current_page',
                     'last_page',
                 ],
             ]);
});

test('list services returns empty when none exist', function () {
    $response = $this->getJson('/api/services');

    $response->assertOk()
             ->assertJsonPath('data.data', []);
});
