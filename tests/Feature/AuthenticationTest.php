<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_and_registration_forms_are_available(): void
    {
        $this->get('/login')->assertOk();
        $this->get('/register')->assertOk();
    }

    public function test_registration_creates_a_user_and_logs_them_in(): void
    {
        $response = $this->post('/register', [
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'admin',
        ]);

        $user = User::query()->where('email', 'budi@example.com')->firstOrFail();

        $this->assertSame('user', $user->role);
        $this->assertTrue(Hash::check('password123', $user->password));
        $response->assertRedirect(route('user.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_registration_validates_email_password_and_confirmation(): void
    {
        $this->from('/register')->post('/register', [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'different',
        ])->assertRedirect('/register')
            ->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function test_login_redirects_admin_and_user_to_their_own_dashboards(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);
        $admin->forceFill(['role' => 'admin'])->save();

        $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ])->assertRedirect(route('admin.dashboard'));

        auth()->logout();

        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'password123',
        ])->assertRedirect(route('user.dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_login_returns_an_error(): void
    {
        $this->post('/login', [
            'email' => 'missing@example.com',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');
    }

    public function test_admin_seeder_creates_a_hashed_admin_account(): void
    {
        $this->seed(AdminSeeder::class);

        $admin = User::query()->where('email', 'admin@gmail.com')->firstOrFail();

        $this->assertSame('admin', $admin->role);
        $this->assertTrue(Hash::check('admin123', $admin->password));
    }

    public function test_dashboards_require_the_correct_role(): void
    {
        $this->get('/admin/dashboard')->assertRedirect(route('login'));

        $user = User::factory()->create();
        $this->actingAs($user)
            ->get('/admin/dashboard')
            ->assertForbidden();

        $admin = User::factory()->create();
        $admin->forceFill(['role' => 'admin'])->save();
        $this->actingAs($admin)
            ->get('/user/dashboard')
            ->assertForbidden();
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
