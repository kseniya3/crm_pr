<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment_file;
use Illuminate\Support\Facades\Validator;
class CommentFilsController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data,[
            'filename'=>['required','unique:comments_files','max:255'],
            'filepath'=>['required','unique:comments_files','max:255'],
        ]);
    }


    public function create(Request $req)
    {
        /* dd($req->all()); */

        $validate=self::validator($req->all());
        if($validate->fails()){
            /* dd($validate->errors()); */
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $comment_file=Comment_file::create([
            'filename' =>$req['filename'] ,
            'filepath' => $req['filepath'],
            
            /* 'user_id' => $req->user()->id, */
        ]);
        
        $comment_file->save();
        return redirect()->route('')->with('success','Сообщение было добавленно');


    }


    public function updateFile($id,Request $req)
    {
        /* dd($req->all()); */
        $validate=self::validator_for_up($req->all());
        if($validate->fails()){
            /* dd($validate->errors()); */
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $comment_file=Comment_file::find($id);
        $comment_file->filename = $req->input('filename');
        $comment_file->filepath = $req->input('filepath');
        
        $comment_file->save();

        return redirect()->route('')->with('success','Сообщение было изменено');

    }

    public function Del($id){
        $comment_file=Comment_file::find($id);
        $comment_file->delete();
        return redirect()->route()->with('success','Сообщение было удалено');
    }
}
