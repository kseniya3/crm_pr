<?php

namespace App\Models;

use App\Traits\CommentFileDeleteTrait;
use Illuminate\Database\Eloquent\Model;

class Comments_files extends Model
{
    use CommentFileDeleteTrait;

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
