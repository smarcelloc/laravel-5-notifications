<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(rand(4,8)),
        'body' => $faker->paragraph(rand(5,15)),
        'post_id' => $faker->randomElement(Post::all(['id'])),
        'user_id' => $faker->randomElement(User::all(['id']))
    ];
});
