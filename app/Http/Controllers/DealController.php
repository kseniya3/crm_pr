<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Deal;
use App\User;
use Carbon\Carbon;

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
    public function index(Deal $deal)
    {
        return view('deal.index',
            ['items'=>$deal->paginate(6)],
            ['users'=>User::get()]
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
    public function store(Request $request)
    {
        $request->validate([
            'deal_name' => 'required|unique:deals,deal_name|max:255',
            'close_date' => 'required|date|after_or_equal:open_data',
            'deal_descrip' => 'max:255',
            'deadline' => 'required|date|after_or_equal:open_data',
            'status' => 'required|max:255'
        ]);
        $carbon = Carbon::now();

        $deal = Deal::create([
            'deal_name' => $request->get('deal_name'),
           'open_date' => $carbon,
           'close_date' => $request->get('close_date'),
           'deal_descrip' => $request->get('deal_descrip'),
            'deadline' => $request->get('deadline'),
            'user_id' => $request->user()->id,
            'status' => $request->get('status')
        ]);

//        $deal->comments()->create([
//            'comment_text' => $request->get('comment'),
//            'user_id' => $request->user()->id,
//            'deal_id' => $deal->id
//        ]);

        if($request->input('clients')):
            $deal->clients()->attach($request->input('clients'));
        endif;

        $deal->save();
        return redirect('/deals')->with('success', 'Contact saved!');

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
    public function update(Request $request, $id)
    {
        $request->validate([
            'deal_name' => 'required',
            'close_date' => '',
            'deal_descrip' => 'max:255',
            'deadline' => 'required',
            'status' => 'required|max:255'
        ]);
        $deal = Deal::find($id);

        $deal->clients()->detach();
        if($request->input('clients')):
            $deal->clients()->attach($request->input('clients'));
        endif;

        //$deal = Deal::find($id);
        $deal->deal_name = $request->get('deal_name');
        $deal->close_date = $request->get('close_date');
        $deal->deal_descrip = $request->get('deal_descrip');
        $deal->deadline = $request->get('deadline');
        //$deal->first_name = $request->get('user_id');
        $deal->status = $request->get('status');
        $deal->save();

        return redirect('/deals')->with('success', 'Contact updated!');
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
        $deal->clients()->detach();
        $deal->delete();

        return redirect('/deals')->with('success', 'Contact deleted!');
    }
}
