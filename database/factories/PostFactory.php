<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory {
    protected $model = Post::class;

    public function definition(): array {
        return [
            'description' => $this->faker->text(),
            'user_id' => 1,
            'original_post_id' => $this->faker->numberBetween(0, 3),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
