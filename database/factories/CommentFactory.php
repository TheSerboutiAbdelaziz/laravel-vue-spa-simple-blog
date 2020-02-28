<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use App\Models\User;
use App\Models\Story;

use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'author_id' => function(){
        		return factory(User::class)->create()->id;
        	},
        'story_id' => function(){
        		return factory(Story::class)->create()->id;
        	}
    ];
});
