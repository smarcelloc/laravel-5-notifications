<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->sentence(rand(4,8)),
        'body' => $faker->paragraph(rand(15,30)),
        'user_id' => $faker->randomElement(User::all(['id']))
    ];
});
