<?php

namespace App\Http\Controllers;

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
        return view('deal.index', ['items'=>$items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deal.creat');
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
            'deal_descrip' => 'required|max:255',
            'deadline' => 'required',
            'status' => 'required|max:255'
        ]);

        $deal = new Deal([
            'deal_name' => $request->get('deal_name'),
            'open_date' => $request->get('open_date'),
            'close_date' => $request->get('close_date'),
            'deal_descrip' => $request->get('deal_descrip'),
            'deadline' => $request->get('deadline'),
            'user_id' => $request->user()->id,
            'status' => $request->get('status')
        ]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
