<?php


namespace App\Traits;

use App\Models\Comments_files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait CommentFileDeleteTrait
{
    public static function deleteFile($id)
    {
        $commentFile = Comments_files::find($id);
        $comment_id = $commentFile->comment_id;
        Storage::disk('public')->delete($commentFile->file_path);
        $commentFile->delete();

        return $comment_id;

        //return redirect()->route('comments.edit', ['id' => $comment_id]);
    }

}
