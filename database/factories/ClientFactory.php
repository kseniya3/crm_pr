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
    return [
        'name' => 'admin',
        'email' => 'fwt_ilia@mail.ru',
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'), // password
        'role' => 'admin',
        'remember_token' => Str::random(10),
    ];
}); */

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
 */
$factory->define(App\Models\Client::class,function(Faker $faker){
    $faker=\Faker\Factory::create('ru_RU');
    return [
    'second_name' => $faker->lastName,
    'first_name' => $faker->firstName,
    'middle_name' => 'Иванович',
    'contacts_telephone' => '89131799877',
    'contacts_email' => $faker->unique()->safeEmail,
    'description' => $faker->sentence(4),
    'company_name' => 'sfu',    
    ];
    
}); 