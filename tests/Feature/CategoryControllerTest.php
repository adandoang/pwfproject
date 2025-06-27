<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticateAdmin()
    {
        $admin = Admin::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $this->actingAs($admin, 'admin');
    }

    /** @test */
    public function it_displays_category_index_page()
    {
        $this->authenticateAdmin();

        $response = $this->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
    }

    /** @test */
    public function it_displays_category_create_form()
    {
        $this->authenticateAdmin();

        $response = $this->get(route('categories.create'));

        $response->assertStatus(200);
        $response->assertViewIs('categories.create');
    }

    /** @test */
    public function it_can_store_a_new_category()
    {
        $this->authenticateAdmin();

        $response = $this->post(route('categories.store'), [
            'category_name' => 'Testing Category',
        ]);

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', [
            'category_name' => 'Testing Category',
        ]);
    }

    /** @test */
    public function it_can_display_edit_form_for_category()
    {
        $this->authenticateAdmin();

        $category = Category::factory()->create();

        $response = $this->get(route('categories.edit', $category->id_category));

        $response->assertStatus(200);
        $response->assertViewIs('categories.edit');
        $response->assertViewHas('category');
    }

    /** @test */
    public function it_can_update_existing_category()
    {
        $this->authenticateAdmin();

        $category = Category::factory()->create([
            'category_name' => 'Old Name',
        ]);

        $response = $this->put(route('categories.update', $category->id_category), [
            'category_name' => 'Updated Name',
        ]);

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', [
            'id_category' => $category->id_category,
            'category_name' => 'Updated Name',
        ]);
    }

    /** @test */
    public function it_can_soft_delete_category()
    {
        $this->authenticateAdmin();

        $category = Category::factory()->create();

        $response = $this->delete(route('categories.destroy', $category->id_category));

        $response->assertRedirect(route('categories.index'));
        $this->assertSoftDeleted('categories', [
            'id_category' => $category->id_category,
        ]);
    }
}
