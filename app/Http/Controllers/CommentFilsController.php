<?php

namespace App\Http\Controllers;

use App\Models\Comments_files;
use App\Traits\CommentFileDeleteTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;

class CommentFilsController extends Controller
{
    public function destroy($id)
    {
        $comment_id = CommentFileDeleteTrait::deleteFile($id);
        return redirect()->route('comments.edit', ['id' => $comment_id]);
    }
}
