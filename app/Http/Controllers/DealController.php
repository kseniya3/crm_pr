<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Deal;
use App\User;

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
        $items = Deal::all();
        $users = User::all();

       return view('deal.index', ['items'=>$items], ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = \App\Models\Client::all();
        return view('deal.creat',['clients'=>$clients]);
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
            'open_date' => 'required',
            'close_date' => '',
            'deal_descrip' => 'max:255',
            'deadline' => 'required',
            'status' => 'required|max:255'
        ]);

        $deal = Deal::create([
            'deal_name' => $request->get('deal_name'),
           'open_date' => $request->get('open_date'),
           'close_date' => $request->get('close_date'),
           'deal_descrip' => $request->get('deal_descrip'),
            'deadline' => $request->get('deadline'),
            'user_id' => $request->user()->id,
            'status' => $request->get('status')
        ]);

        $client = Client::find($request->client_id);
        $deal->clients()->attach($client);

        $deal->save();
        return redirect('/deals')->with('success', 'Contact saved!');

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
    public function edit(Request $request, $id)
    {
        $deal = Deal::find($id);
        $user = User::find($deal->user_id);
        //dd(User::find($deal->user_id));

        return view('deal.edit', ['deal'=>$deal], ['user'=>$user]);
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
            'open_date' => 'required',
            'close_date' => '',
            'deal_descrip' => 'max:255',
            'deadline' => 'required',
            'status' => 'required|max:255'
        ]);

        $deal = Deal::find($id);
        $deal->deal_name = $request->get('deal_name');
        $deal->open_date = $request->get('open_date');
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



        $deal->delete();

        return redirect('/deals')->with('success', 'Contact deleted!');
    }
}
