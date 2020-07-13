<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    $user=new User();
    $user->login="Костян";
    $user->email="kostyan@mail.com";
    $user->password="1234";
    $user->client_id=1;
    $user->comment_id=1;
    $user->save();
    protected $table = 'users';
}
