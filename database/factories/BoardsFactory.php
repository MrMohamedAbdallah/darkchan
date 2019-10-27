<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Board::class, function (Faker $faker) {
    return [
        'name'  => $faker->unique()->name(),
        'link'  => $faker->unique()->name(),
        'msg'   => $faker->text(64),
        'cover' => '',
        'nsfw'  => intval(rand() * 10) % 2
    ];

});
