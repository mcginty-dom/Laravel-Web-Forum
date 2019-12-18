<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
        'header' => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'body' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'user_id' => App\User::inRandomOrder()->first()->id,
    ];
});
