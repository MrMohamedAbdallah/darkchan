<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Board::class, function (Faker $faker) {
    return [
        'name'  => $faker->unique()->name(),
        'link'  => $faker->unique()->name(),
        'msg'   => $faker->text(64),
        'cover' => '',
        'nsfw'  => intval(rand() * 10) % 2
    ];

});

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        "title"    => $faker->text(30),
        "name"     => "Anonymous", 
        "content"  => $faker->paragraph(2),
        "file"     => "",
        "password" => Hash::make("password"),
        "board_id" => 1
    ];

});
