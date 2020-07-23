<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;

$factory->define(App\Models\Deal::class,function(Faker $faker){
    $array=['open','closed'];
    $carbon = Carbon::now();
    return [
        'deal_name'=>Str::random(10),
        'open_date'=>$carbon,
        'close_date'=>$carbon->addDays(rand(2, 10)),
        'deal_descrip'=>$faker->sentence(4),
        'deadline'=>$carbon->addDays(rand(2, 15)),
        'status'=>Arr::random($array),   
    ];
    
}); 