<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

/* $factory->define(User::class,function (Faker $faker) {
    $array=['admin','manager'];
    return [
        'name' => Str::random(10),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'), // password
        'role' => Arr::random($array),
        'remember_token' => Str::random(10),
    ];
}); */
$factory->define(User::class,function (Faker $faker) {
    
    return [
        'name' => 'admin',
        'email' => "fwt_ilya@mail.ru",
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'), // password
        'role' => 'admin',
        'remember_token' => Str::random(10),
    ];
});

/* $factory->defineAs(User::class, 'admin',function(Faker $faker){
        return [
            'name' => 'admin',
            'email' => 'fwt_ilia@mail.ru',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ];
});

$factory->defineAs(App\Models\Client::class, 'admin',function(Faker $faker){
    return [
        'second_name' => 'ilyas',
    'first_name' => 'laige',
    'middle_name' => 'ilya',
    'contacts_telephone' => '89131799877',
    'contacts_email' => 'fwt_ilka@mail.ru',
    'description' => 'Классный и милый парень заводной пацн и просто молодец',
    'company_name' => 'sfu',    
    ];
    
}); */