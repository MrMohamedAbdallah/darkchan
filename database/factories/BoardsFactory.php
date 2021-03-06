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
        'nsfw'  => rand() % 2
    ];

});

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        "title"    => $faker->text(30),
        "name"     => "Anonymous", 
        "content"  => $faker->paragraph(2),
        "file1"     => "",
        "file2"     => "",
        "password" => Hash::make("password"),
        "spoiler" => rand() % 2,
        'last_action'   => date('Y-m-d H:i:s'),

    ];

});
$factory->define(App\Comment::class, function (Faker $faker) {
    return [
            "name"  => 'Anonymous',
            "content"   => $faker->paragraph(3),
            "file1"  => '',
            "file2"  => '',
            "password"  => Hash::make('password'),
            'spoiler'   => rand() % 2,
    ];

});