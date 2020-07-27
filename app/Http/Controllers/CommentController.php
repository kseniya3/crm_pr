<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Comment;
use App\Models\Deal;
use App\User;
use App\Models\Comments_files;
use Illuminate\Http\Request;
use App\Traits\CommentFileDeleteTrait;

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = Comment::create([
            'comment_text' => $request->get('comment_text'),
            'user_id' => $request->get('user_id'),
            'deal_id' => $request->get('deal_id')
        ]);

        if($request->get('filename') != NULL)
        {
            $path = $request->file('file_path')->store('uploads', 'public');
            $comment->commentsFile()->create([
                'filename' => $request->get('filename'),
                'file_path' => $path,
                'comment_id' => $comment->id
            ]);
        }
        $comment->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deal = Deal::find($id);
        $comments = $deal->comments()->paginate(5);

        return view('Comment.index',
            ['deal'=>$deal,
                'comments'=>$comments]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);

        return view('Comment.edit',
            ['deal' => $comment->deal],
             ['comments' => $comment,
              'commentFiles' => $comment->commentsFile]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->comment_text = $request->get('comment_text');
        $comment->user_id = $request->get('user_id');
        $comment->deal_id = $request->get('deal_id');
        $comment->save();

        return redirect()->route('comments.show', ['id' => $comment->deal_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        foreach ($comment->commentsFile as $file)
        {
            CommentFileDeleteTrait::deleteFile($file->id);
        }
        $comment->commentsFile()->delete();
        $comment->delete();

        return redirect()->back();
    }

    public function storeFile(Request $request)
    {
        $comment = Comment::find($request->get('comment_id'));

        $path = $request->file('file_path')->store('uploads', 'public');

        $comment->commentsFile()->create([
            'filename' => $request->get('filename'),
            'file_path' => $path,
            'comment_id' => $comment->id
        ]);
        $comment->save();

        return redirect()->back();
    }

}
