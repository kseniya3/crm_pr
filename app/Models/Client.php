<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    @var array
    
    protected $fillable = [
        'second_name','first_name','middle_name','contact_telephone', 'contact_email', 'discription', 'company_name',
    ];
}
