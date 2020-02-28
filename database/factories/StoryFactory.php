<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Story;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Story::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->sentence(4),
        'content' => $faker->paragraph,
        'category_name' => $faker->randomElement(['Angular','Laravel','Vue']),
        'image' => $faker->randomElement(['story-3164843868.jpg','story-3164990310.jpg','story-3164992162.jpg']),
        'author_id' => function(){
        		return factory(User::class)->create()->id;
        	}
    ];
});
