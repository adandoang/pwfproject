<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'kutipan' => fake()->text(100),
            'meta_keyword' => fake()->word(),
            'meta_description' => fake()->sentence(),
            'body' => fake()->paragraph(4),
            'admin_id' => Admin::factory(), // auto-create admin jika tidak ada
        ];
    }
}
