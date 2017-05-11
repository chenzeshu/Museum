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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Folder::class, function(\Faker\Generator $faker){
    return [
        'name' => $faker->name,
        'desc' => str_random(10)
    ];
});

$factory->define(\App\File::class, function(\Faker\Generator $faker){
    return [
        'folder_name' => $faker->name,  //测试时就不管名字了
        'name'=>$faker->name,
        'time'=>$faker->time(),
        'type'=>str_random(5),
        'troupe'=>str_random(5),
        'address'=>str_random(5),
        'actor'=>str_random(6),
        'drama'=>str_random(20),
        'size'=>rand(0,100),
        'ext'=>".".str_random(4),
        'path'=>str_random(10),
        'remark'=>str_random(5)
    ];
});