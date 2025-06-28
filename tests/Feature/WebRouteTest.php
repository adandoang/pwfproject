<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class WebRouteTest extends TestCase
{
    // use RefreshDatabase;

    public function test_homepage_is_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_public_article_detail_page()
    {
        $admin = Admin::factory()->create();
        $article = \App\Models\Article::factory()->create(['admin_id' => $admin->id_admin]);

        $response = $this->get('/public/articles/' . $article->id_article);
        $response->assertStatus(200);
    }

    public function test_login_page_is_accessible()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_register_page_is_accessible()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_admin_dashboard_requires_authentication()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login'); // default if not logged in
    }

    public function test_authenticated_admin_can_access_dashboard()
    {
        $admin = Admin::factory()->create([
            'password' => Hash::make('password123')
        ]);

        $this->actingAs($admin, 'admin'); // login as admin guard

        $response = $this->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_articles_index_requires_authentication()
    {
        $response = $this->get('/articles');
        $response->assertRedirect('/login');
    }

    public function test_categories_index_requires_authentication()
    {
        $response = $this->get('/categories');
        $response->assertRedirect('/login');
    }
}
