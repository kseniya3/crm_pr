<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments_files extends Model
{
    protected $fillable = [
        'filename',
        'file_path',
        'comment_id'
    ];

    public function fileCom()
    {
        return $this->belongsTo('App\Models\Comment','comment_id', 'id');
    }
}
