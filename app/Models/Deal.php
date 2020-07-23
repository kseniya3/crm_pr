<?php

namespace App\Models;

use App\Traits\CommentFileDeleteTrait;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder;

class Deal extends Model
{
    use CommentFileDeleteTrait;

    protected $fillable = [
        'deal_name',
        'open_date',
        'close_date',
        'deal_descrip',
        'deadline',
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client', 'clients_has_deals','deal_id','client_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

}
