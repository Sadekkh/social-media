<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();
        Gate::define("post_owner", function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });
        Gate::define("is_original_post", function (User $user, Post $post) {
            return $post->original_post_id === null;
        });
        Gate::define("comment_owner", function (User $user, Comment $comment) {
            return $user->id === $comment->user->id;
        });

    }
}
