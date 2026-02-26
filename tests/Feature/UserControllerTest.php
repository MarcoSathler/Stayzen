<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    // -----------------------------------------------------------------
    // index (página de registro)
    // -----------------------------------------------------------------

    /**
     * Testa se a página de registro retorna status 200.
     */
    public function test_index_returns_register_page(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    // -----------------------------------------------------------------
    // loginPage
    // -----------------------------------------------------------------

    /**
     * Testa se a página de login retorna status 200.
     */
    public function test_login_page_returns_successful_response(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    // -----------------------------------------------------------------
    // edit (página de perfil)
    // -----------------------------------------------------------------

    /**
     * Testa se a página de perfil retorna 200 para usuário autenticado.
     */
    public function test_edit_returns_profile_page_when_authenticated(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.profile');
        $response->assertViewHas('user', $user);
    }

    /**
     * Testa se usuário não autenticado é redirecionado ao acessar o perfil.
     */
    public function test_edit_redirects_unauthenticated_user(): void
    {
        $response = $this->get(route('profile.edit'));

        $response->assertRedirect(route('login'));
    }

    // -----------------------------------------------------------------
    // store (criação de usuário)
    // -----------------------------------------------------------------

    /**
     * Testa se um usuário pode ser registrado com dados válidos.
     */
    public function test_store_creates_user_with_valid_data(): void
    {
        $payload = [
            'name'                  => 'João Teste',
            'email'                 => 'joao@example.com',
            'password'              => 'senha_segura_123',
            'password_confirmation' => 'senha_segura_123',
            'role'                  => 'customer',
        ];

        $this->post(route('register'), $payload);

        $this->assertDatabaseHas('users', ['email' => 'joao@example.com']);
    }

    /**
     * Testa se store falha com campos obrigatórios ausentes.
     */
    public function test_store_fails_without_required_fields(): void
    {
        $response = $this->post(route('register'), []);

        // name, email e role são required; password é nullable no FormRequest
        $response->assertSessionHasErrors(['name', 'email', 'role']);
    }

    /**
     * Testa se store falha com e-mail inválido.
     */
    public function test_store_fails_with_invalid_email(): void
    {
        $response = $this->post(route('register'), [
            'name'  => 'Teste',
            'email' => 'nao-e-um-email',
            'role'  => 'customer',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Testa se store falha com role inválida.
     */
    public function test_store_fails_with_invalid_role(): void
    {
        $response = $this->post(route('register'), [
            'name'  => 'Teste',
            'email' => 'teste@example.com',
            'role'  => 'superadmin', // não está na lista
        ]);

        $response->assertSessionHasErrors(['role']);
    }

    // -----------------------------------------------------------------
    // login
    // -----------------------------------------------------------------

    /**
     * Testa se um usuário existente consegue fazer login.
     */
    public function test_login_authenticates_valid_user_and_redirects_to_home(): void
    {
        // A coluna is_deleted é consultada no LoginAuthRequest
        $user = User::factory()->create([
            'password'  => Hash::make('senha_segura'),
            'is_deleted' => 0,
        ]);

        $response = $this->post(route('login'), [
            'email'    => $user->email,
            'password' => 'senha_segura',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Testa se login falha com credenciais inválidas.
     */
    public function test_login_fails_with_wrong_password(): void
    {
        $user = User::factory()->create([
            'password'  => Hash::make('senha_correta'),
            'is_deleted' => 0,
        ]);

        $response = $this->post(route('login'), [
            'email'    => $user->email,
            'password' => 'senha_errada',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    /**
     * Testa se login falha quando campos obrigatórios estão ausentes.
     */
    public function test_login_fails_without_credentials(): void
    {
        $response = $this->post(route('login'), []);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    // -----------------------------------------------------------------
    // update (atualização de perfil)
    // -----------------------------------------------------------------

    /**
     * Testa se o perfil do usuário pode ser atualizado com dados válidos.
     */
    public function test_update_updates_user_profile(): void
    {
        $user = User::factory()->create([
            'name'  => 'Nome Antigo',
            'email' => 'antigo@example.com',
            'role'  => 'customer',
        ]);

        $response = $this->actingAs($user)->patch(route('profile.update'), [
            'name'  => 'Nome Novo',
            'email' => 'novo@example.com',
            'role'  => 'customer',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users', [
            'id'    => $user->id,
            'name'  => 'Nome Novo',
            'email' => 'novo@example.com',
        ]);
    }

    /**
     * Testa se update falha com campos obrigatórios ausentes.
     */
    public function test_update_fails_without_required_fields(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patch(route('profile.update'), []);

        $response->assertSessionHasErrors(['name', 'email', 'role']);
    }

    /**
     * Testa se usuário não autenticado é redirecionado ao tentar atualizar perfil.
     */
    public function test_update_redirects_unauthenticated_user(): void
    {
        $response = $this->patch(route('profile.update'), [
            'name'  => 'Qualquer Nome',
            'email' => 'qualquer@example.com',
            'role'  => 'customer',
        ]);

        $response->assertRedirect(route('login'));
    }
}
