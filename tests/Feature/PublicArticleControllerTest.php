<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicArticleControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function test_displays_article_index_page()
    {
        // Arrange
        $admin = Admin::factory()->create();
        Article::factory()->count(3)->create(['admin_id' => $admin->id_admin]);

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('public.articles.index');
        $response->assertViewHas('articles');
    }

    public function test_displays_article_index_with_search()
    {
        $admin = Admin::factory()->create();

        Article::factory()->create([
            'title' => 'Laravel Testing',
            'admin_id' => $admin->id_admin
        ]);

        Article::factory()->create([
            'title' => 'Another Article',
            'admin_id' => $admin->id_admin
        ]);

        $response = $this->get('/?search=Laravel');

        $response->assertStatus(200);
        $response->assertSee('Laravel Testing');
        $response->assertDontSee('Another Article');
    }

    public function test_displays_article_show_page()
    {
        // Arrange
        $admin = Admin::factory()->create();
        $article = Article::factory()->create(['admin_id' => $admin->id_admin]);

        // Act
        $response = $this->get("/public/articles/{$article->id_article}");

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('public.articles.show');
        $response->assertViewHas('article');
        $response->assertSee($article->title);
    }
}
