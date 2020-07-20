<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment_file extends Model
{
    protected $fillable = [
        'filename',
        'filepath',
        
    ];
}
