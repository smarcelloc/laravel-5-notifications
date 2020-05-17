<?php

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //  Varíavel constante pertinente a classe
    const MAX_FACTORY = 30;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, self::MAX_FACTORY)->create();
        factory(Post::class, self::MAX_FACTORY * 3)->create();
        factory(Comment::class, self::MAX_FACTORY * 7)->create();
    }
}
