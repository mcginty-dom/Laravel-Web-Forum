<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        //
        'body' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'user_id' => App\User::inRandomOrder()->first()->id,
        'post_id' => App\Post::inRandomOrder()->first()->id,
    ];
});
