<?php

namespace Database\Factories;

use App\Enums\FeaturedStatus;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => $this->faker->words(5, true),
            'slug' => $this->faker->slug,
            'description' => $this->faker->sentence,
            'image' => 'https://picsum.photos/1800/300?x='.rand(),
            'body' => $this->faker->text(1600),
            'published_at' => $this->faker->dateTimeBetween('-1 month', '+3 months'),
            'is_featured' => $this->faker->randomElement(array_column(FeaturedStatus::cases(), 'value')),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $tags = Tag::inRandomOrder()->take(rand(1, 4))->get();
            $post->tags()->attach($tags);
        });
    }
}
