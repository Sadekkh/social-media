<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CommentFactory extends Factory {
    protected $model = Comment::class;

    public function definition(): array {
        return [
            'user_id' => 1,
            'post_id' => Post::all()->random()->id,
            'parent_id' => 1,
            'comment' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
