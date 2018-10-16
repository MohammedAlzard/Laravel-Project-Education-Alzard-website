<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
     return [
    	'uniqid' => uniqid(),
    	'type_user' => 'Admin',
    	'image' => 'user-image.png',
        'name' => 'Mohammed A. Alzard',
        'email' => 'mm@mm.mm',
        'password' => bcrypt(123123), // secret
        'remember_token' => str_random(10),
        'confirmed' => 1,
        'created_at'=> $faker->dateTime()
    ];
});