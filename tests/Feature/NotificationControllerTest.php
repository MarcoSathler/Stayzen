<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;

class NotificationControllerTest extends TestCase
{
    use RefreshDatabase;

    // -----------------------------------------------------------------
    // index
    // -----------------------------------------------------------------

    /**
     * Testa se a listagem de notificações retorna 200 para usuário autenticado.
     */
    public function test_index_returns_successful_response_when_authenticated(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('notifications.index'));

        $response->assertStatus(200);
    }

    /**
     * Testa se a view correta é retornada.
     */
    public function test_index_returns_correct_view(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('notifications.index'));

        $response->assertViewIs('notifications.index');
        $response->assertViewHas('notifications');
    }

    /**
     * Testa se usuário não autenticado é redirecionado.
     */
    public function test_index_redirects_unauthenticated_user(): void
    {
        $response = $this->get(route('notifications.index'));

        $response->assertRedirect(route('login'));
    }

    // -----------------------------------------------------------------
    // read
    // -----------------------------------------------------------------

    /**
     * Testa se uma notificação é marcada como lida com sucesso.
     */
    public function test_read_marks_notification_as_read_and_redirects(): void
    {
        $user = User::factory()->create();

        // Cria uma notificação de banco de dados manualmente para o usuário
        $notification = $user->notifications()->create([
            'id'              => \Illuminate\Support\Str::uuid(),
            'type'            => 'App\\Notifications\\TestNotification',
            'notifiable_type' => User::class,
            'notifiable_id'   => $user->id,
            'data'            => json_encode(['message' => 'test']),
            'read_at'         => null,
        ]);

        $response = $this->actingAs($user)
            ->post(route('notifications.read', $notification->id));

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertNotNull(
            DatabaseNotification::find($notification->id)?->read_at,
            'A notificação deveria estar marcada como lida.'
        );
    }

    /**
     * Testa se tentar marcar notificação inexistente retorna erro customizado.
     */
    public function test_read_handles_nonexistent_notification(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('notifications.read', 'id-inexistente-uuid'));

        $response->assertViewIs('errors.custom');
    }

    /**
     * Testa se usuário não autenticado é redirecionado ao tentar marcar como lida.
     */
    public function test_read_redirects_unauthenticated_user(): void
    {
        $response = $this->post(route('notifications.read', 'qualquer-id'));

        $response->assertRedirect(route('login'));
    }
}
