<?php

namespace App\Providers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Only permission user auth
         */
        Gate::define('post-auth', function(User $user, Post $post){
            return $user->id == $post->user_id;
        });
        
        /**
         * Only permission user auth
         */
        Gate::define('comment-auth', function(User $user, Comment $comment){
            return $user->id == $comment->post->user_id || $comment->user_id == $user->id;
        });
    }
}
