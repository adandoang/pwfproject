<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_register()
    {
        $response = $this->post(route('register'), [
            'nama_admin' => 'Admin Baru',
            'username' => 'adminbaru',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('admins', [
            'nama_admin' => 'Admin Baru',
            'username' => 'adminbaru',
        ]);
    }

    /** @test */
    public function admin_can_login_with_correct_credentials()
    {
        $admin = Admin::create([
            'nama_admin' => 'Admin Login',
            'username' => 'adminlogin',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('login'), [
            'username' => 'adminlogin',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    /** @test */
    public function admin_cannot_login_with_invalid_credentials()
    {
        $admin = Admin::create([
            'nama_admin' => 'Admin Salah',
            'username' => 'adminsalah',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->from(route('login'))->post(route('login'), [
            'username' => 'adminsalah',
            'password' => 'salahpassword',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('username');
        $this->assertGuest('admin');
    }

    /** @test */
    public function admin_can_logout()
    {
        $admin = Admin::factory()->create([
            'password' => Hash::make('password123')
        ]);

        $this->actingAs($admin, 'admin');

        $response = $this->post(route('logout'));

        $response->assertRedirect('/');
        $this->assertGuest('admin');
    }
}
