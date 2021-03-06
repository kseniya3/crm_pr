<?php

namespace App\Http\Controllers;

use App\Jobs\ClientDealJob;
use App\Mail\EmailClientHello;
use App\Models\Client;
use App\Models\Comment;
use App\Traits\CommentFileDeleteTrait;
use Illuminate\Http\Request;
use App\Models\Deal;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;


class DealController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('deal.index',
        ['items'=>Deal::with('clients','user')->paginate(4)]
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deal.creat',
        ['clients'=> Client::get()]
    );
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected function validator(array $data,$str_Carbon)
    {
        return Validator::make($data,[
            'deal_name' => 'required|unique:deals,deal_name|max:30',
            /* 'close_date' => 'after_or_equal:'.$str_Carbon, */
            'deal_descrip' => 'max:255',
            'deadline' => 'required|date|after_or_equal:'.$str_Carbon,
           /*  'status' => 'required|max:255' */
        ],['close_date.after_or_equal'=>'The closing date cannot be earlier than the opening date',
        'deadline.after_or_equal'=>'The deadline date cannot be earlier than the opening date',]);
    }

    public function store(Request $request)
    {
        $carbon = Carbon::now();
        $str_Carbon=(String)$carbon;
        $validate=self::validator($request->all(),$str_Carbon);
        if($validate->fails()){
            /* dd($validate->errors()); */
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if($request->get('status')!='open'){
            $date_close=Carbon::now();
        }
        $deal = Deal::create([
            'deal_name' => $request->get('deal_name'),
            'open_date' => $carbon,
            /* 'close_date' => $request->get('close_date'), */
            'deal_descrip' => $request->get('deal_descrip'),
            'deadline' => $request->get('deadline'),
            'user_id' => $request->user()->id,
            'status' => 'open'
        ]);

        $comment = $request->get('comment_text');

        if($comment != NULL)
        {
            $deal->comments()->create([
                'comment_text' => $comment,
                'user_id' => $request->user()->id,
                'deal_id' => $deal->id
            ]);
        }

        if($request->input('clients')):
            $deal->clients()->attach($request->input('clients'));
        endif;

        foreach ($deal->clients as $client)
        {
            Mail::to($client->contacts_email)->send(new EmailClientHello($client, $deal));
        }

        if($deal)
        {
            $deal->save();
            return redirect('/deals')->with(['success' => 'Успешно сохранено']);
        }else{
            return back()->withErrors(['msg' => 'Ошибка сохранения!'])->withInput();
        }

    }
    protected function FindDeal(Request $req)
    {

        $items = Deal::all();
        $findznach=$req->input('find');
        if($req->input('find')==""){
            return view('Client.client_show', ['items'=>$items]);
        }
        $columns = [
            'deal_name',
            'open_date',
            'close_date',
            'deal_descrip',
            'deadline',
            'user_id',
            'status'
        ];
        $query = Deal::select('*');
        foreach($columns as $column)
        {
            $query->orWhere($column, 'LIKE', $findznach."%");
        }
        $client = $query->get();

        return view('Deal.show', ['items'=>$client]);
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

        return view('deal.show',
            ['deal'=>$deal]
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
        $deal = Deal::find($id);
        $user = User::find($deal->user_id);

        return view('deal.edit',
            ['deal'=>$deal,
                'clients'=> Client::get()],
            ['user'=>$user]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    protected function up_validator(array $data,$str_Carbon)
    {
        return Validator::make($data,[
            'deal_name' => 'required|max:30',
            /* 'close_date' => 'after_or_equal:'.$str_Carbon, */
            'deal_descrip' => 'max:255',
            'deadline' => 'required|date|after_or_equal:'.$str_Carbon,
            /* 'status' => 'required|max:255' */
        ],['close_date.after_or_equal'=>'The closing date cannot be earlier than the opening date',
        'deadline.after_or_equal'=>'The deadline date cannot be earlier than the opening date',]);
    }
    public function update(Request $request, $id)
    {

        $deal = Deal::find($id);
        $validate=self::up_validator($request->all(),(string)$deal->open_date);
        if($validate->fails()){
            /* dd($validate->errors()); */
            return redirect()->back()->withErrors($validate)->withInput();
        }


        $deal->clients()->detach();
        if($request->input('clients'))
        {
            $deal->clients()->attach($request->input('clients'));
        }

        if($request->get('status')!='open'){
            $date_close=Carbon::now();
        }else{
            $date_close=null;
        }


        $deal->deal_name = $request->get('deal_name');
        $deal->close_date = $date_close;
        $deal->deal_descrip = $request->get('deal_descrip');
        $deal->deadline = $request->get('deadline');
        //$deal->first_name = $request->get('user_id');
        $deal->status = $request->get('status');


        $deal->save();

        foreach ($deal->clients as $client)
        {
            Mail::to($client->contacts_email)->send(new EmailClientHello($client, $deal));
        }

        if($deal)
        {
            $deal->save();
            return redirect('/deals')->with(['success' => 'Успешно сохранено']);
        }else{
            return back()->withErrors(['msg' => 'Ошибка сохранения!'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deal = Deal::find($id);
        $comments = Comment::where('deal_id', $id)->get();

        foreach ($comments as $comment)
        {
            $files = $comment->commentsFile;
            foreach ($files as $file)
            {
                CommentFileDeleteTrait::deleteFile($file->id);
            }
            $comment->commentsFile()->delete();
            $comment->delete();
        }

        $deal->clients()->detach();
        $deal->delete();

        return response()->json([
            'status'=>'OK',
            'msg'=> $id
            ]);
    }


    public function getDeals()
    {
        $deal=Deal::all();
        
        $url_data=((array)$deal);
        /* dd($url_data); */
        return view('Client.client_temp',['url_data'=>$url_data]);
    }
}
