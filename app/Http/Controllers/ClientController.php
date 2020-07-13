<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
class ClientController extends Controller
{
    protected function validator(array $data){
        return Validator::make($data,[
            'second_name' => ['required','string','max:15'],
            'first_name' => ['required','string','max:15'],
            'middle_name' => ['required','string','max:15'],
            'contact_telephone' => ['required','string','max:15'],
            'contact_email' => ['required','string','max:15'],
            'discription' => ['required','string','max:500'],
            'company_name' => ['required','string','max:15'],
        ]);
    }

    protected function index(){
        echo "hi";
    }
    protected function create(array $data){
        return Client::create([
            'second_name' =>$data['second_name'] ,
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'contact_telephone' => $data['contact_telephone'],
            'contact_email' => $data['contact_email'],
            'discription' => $data['discription'],
            'company_name' => $data['company_name'],
        ]);
    }
}
