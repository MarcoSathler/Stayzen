<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se a página inicial retorna status 200.
     */
    public function test_index_returns_successful_response(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }

    /**
     * Testa se a view correta é retornada.
     */
    public function test_index_returns_correct_view(): void
    {
        $response = $this->get(route('home'));

        $response->assertViewIs('reservations.index');
    }

    /**
     * Testa se a variável 'accommodations' é passada para a view.
     */
    public function test_index_passes_accommodations_to_view(): void
    {
        $response = $this->get(route('home'));

        $response->assertViewHas('accommodations');
    }
}
