<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $client = Client::find($id);
        // dd(json_encode($deal));

        return view('Report.index',
            ['client' => $client]
        );
    }

    public function generator($id)
    {
        $client = Client::find($id);
        $deals = $client->deals;
        dd($deals);
    }


}
