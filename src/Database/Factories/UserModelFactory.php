<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(OliveMedia\OliveMediaNews\Entities\News\News::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->name,
        'description' => $faker->text,
        'image' => $faker->image('public/storage/images', 400, 300, null, false),
        'video' => "abc.mp4",
        'attachment' => "abc.pdf",
    ];
});
