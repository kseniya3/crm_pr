<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /*  $oDeal=factory(App\Models\Deal::class,5)->create()->each(function($deal){
            $deal->clients()->save(factory(App\Models\Client::class)->make());
        }); */
        
        factory(App\User::class,1)->create()->each(function($user){
            $client=$user->clients()->save(factory(App\Models\Client::class)->make());
            $deal=$user->deals()->save(factory(App\Models\Deal::class)->make());
            /* $comment=$user->comments()->save(factory(App\Models\Comment::class)->make()); */
            $client->deals()->attach($deal);
            /* $deal->comments()->attach($comment); */
            $comment=$deal->comments()->save(factory(App\Models\Comment::class)->make());
            //$comment->users()->attach($user);
            
        });
        
    }
}
