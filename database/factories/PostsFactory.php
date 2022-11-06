<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = mt_rand(1, 3);
        $thumbCategory = Categories::find($category)->name;
        return [
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            // 'body' =>
            //     '<p>' .
            //     implode('</p><p>' . $this->faker->paragraphs(mt_rand(5, 10))) .
            //     '</p>',
            'body' => collect($this->faker->paragraphs(mt_rand(8, 23)))
                ->map(fn($p) => "<p>$p</p>")
                ->implode(''),
            'thumbnail' =>
                'https://source.unsplash.com/1280x720?' . $thumbCategory,
            'category_id' => mt_rand(1, 3),
            'user_id' => mt_rand(1, 1),
            'meta_keyword' =>
                'cara menjadi kocak, apakah kadal itu, kamu adalah aku, kita ada disini',
            'meta_description' => $this->faker->paragraph(),
            'published_at' => mt_rand(1, 2) == 1 ? now() : null,
        ];
    }
}
