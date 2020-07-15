<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'deal_name',
        'open_date',
        'close_date',
        'deal_descrip',
        'deadline',
        'user_id',
        'status'      
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}