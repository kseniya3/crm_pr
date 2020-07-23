<?php

namespace App\Models;

use App\Traits\CommentFileDeleteTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use CommentFileDeleteTrait;

    protected $fillable = [
        'comment_text',
        'user_id',
        'deal_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function deals()
    {
        return $this->belongsTo('App\Models\Deal');
    }

    public function commentsFile()
    {
        return $this->hasMany('App\Models\Comments_files');
    }

}
