<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = rtrim($this->faker->sentence(6), '.');
        $covers = [
            'images/news1.jpg',
            'images/news2.jpg',
            'images/news3.jpg',
        ];

        return [
            'title'   => $title,
            'slug'    => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1000, 99999),
            'image'   => $this->faker->randomElement($covers),
            'excerpt' => $this->faker->text(180),
            'body'    => collect($this->faker->paragraphs(5))->implode("\n\n"),
        ];
    }
}
