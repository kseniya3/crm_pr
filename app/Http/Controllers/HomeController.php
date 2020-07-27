<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $deal = Deal::where('user_id', Auth::id())->paginate(4);
        $clients = Client::where('user_id', Auth::id())->paginate(1);

        return view('home',
            ['deals'=>$deal],
            ['clients'=>$clients]
        );
    }
}
