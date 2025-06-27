<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_article_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get('/articles');
        $response->assertStatus(200)->assertViewIs('articles.index');
    }

    public function test_article_create_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get('/articles/create');
        $response->assertStatus(200)->assertViewIs('articles.create');
    }

    public function test_article_can_be_stored()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');
        Storage::fake('public');

        $category = Category::factory()->create();

        $data = [
            'title' => 'Test Article',
            'kutipan' => 'Ini kutipan',
            'meta_keyword' => 'test',
            'meta_description' => 'meta test',
            'body' => 'Konten lengkap artikel',
            'thumbnail' => UploadedFile::fake()->image('thumb.jpg'),
            'categories' => [$category->id_category],
        ];

        $response = $this->post('/articles', $data);

        $response->assertRedirect('/articles');
        $this->assertDatabaseHas('articles', ['title' => 'Test Article']);
    }

    public function test_article_show_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $article = Article::factory()->create(['admin_id' => $admin->id_admin]);

        $response = $this->get('/articles/' . $article->id_article);
        $response->assertStatus(200)->assertViewIs('public.articles.show');
    }

    public function test_article_edit_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $article = Article::factory()->create(['admin_id' => $admin->id_admin]);

        $response = $this->get('/articles/' . $article->id_article . '/edit');
        $response->assertStatus(200)->assertViewIs('articles.edit');
    }

    public function test_article_can_be_updated()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');
        Storage::fake('public');

        $article = Article::factory()->create(['admin_id' => $admin->id_admin]);

        $newData = [
            'title' => 'Updated Title',
            'kutipan' => 'Updated kutipan',
            'meta_keyword' => 'updated',
            'meta_description' => 'updated desc',
            'body' => 'updated body',
            'thumbnail' => UploadedFile::fake()->image('new.jpg'),
            'categories' => [],
        ];

        $response = $this->put('/articles/' . $article->id_article, $newData);

        $response->assertRedirect('/articles');
        $this->assertDatabaseHas('articles', ['title' => 'Updated Title']);
    }

    public function test_article_can_be_deleted()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $article = Article::factory()->create(['admin_id' => $admin->id_admin]);

        $response = $this->delete('/articles/' . $article->id_article);

        $response->assertRedirect('/articles');
        $this->assertSoftDeleted('articles', ['id_article' => $article->id_article]);
    }
}
