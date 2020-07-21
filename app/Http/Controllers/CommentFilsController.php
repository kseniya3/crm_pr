<?php

namespace App\Http\Controllers;

use App\Models\Comments_files;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class CommentFilsController extends Controller
{
    public function destroy($id)
    {
        $commentFile = Comments_files::find($id);
        $comment_id = $commentFile->comment_id;
        $commentFile->delete();

        return redirect('/deals')->with('success', 'Contact deleted!');
    }
}
