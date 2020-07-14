<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    protected function validator(array $data){
        return Validator::make($data,[
            'second_name' => ['required','string','min:2','max:15'],
            'first_name' => ['required','string','max:15'],
            'middle_name' => ['required','string','max:15'],
            'contacts_telephone' => ['required','string','max:15'],
            'contacts_email' => ['required','string','max:15'],
            'description' => ['string','max:500'],
            'company_name' => ['required','string','max:15'],
        ]);
    }

    protected function index(){
        echo "hi";
    }
    public function create(Request $req){
        /* dd($req->all()); */
        $validate=self::validator($req->all());
        if($validate->fails()){
            /* dd($validate->errors()); */
            return redirect()->back()->withErrors($validate)->withInput();
        }
        
        Client::create([
            'second_name' =>$req['second_name'] ,
            'first_name' => $req['first_name'],
            'middle_name' => $req['middle_name'],
            'contacts_telephone' => $req['contacts_telephone'],
            'contacts_email' => $req['contacts_email'],
            'description' => $req['description'],
            'company_name' => $req['company_name'],
            'user_id' => $req->user()->id,
        ]);
        return redirect()->back()->withInput();
    }
    
}
