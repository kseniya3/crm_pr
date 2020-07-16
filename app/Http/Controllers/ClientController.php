<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
   
    
    protected function validator(array $data)
    {
        return Validator::make($data,[
            'second_name' => ['required','string','min:2','max:30'],
            'first_name' => ['required','string','min:2','max:30'],
            'middle_name' => ['required','string','min:2','max:30'],
            'contacts_telephone' => ['unique:clients','required','string','min:11','max:12'],
            'contacts_email' => ['unique:clients','required','string','max:30'],
            'description' => ['max:500'],
            'company_name' => ['required','string','max:30'],
        ]/* ,[ 'second_name.required'=>'Поле имя не заполнено',] */);
    }

    protected function Show()
    {
        $items = Client::all();
        return view('Client.client_show', ['items'=>$items]);
    }
    protected function FindClient(Request $req)
    {
        
        $items = Client::all();
        $findznach=$req->input('find');
        if($req->input('find')==""){
            return view('Client.client_show', ['items'=>$items]);
        }
        $columns = [
            'second_name',
            'first_name',
            'middle_name',
            'contacts_telephone',
            'contacts_email',
            'description',
            'company_name',
            'user_id',
        ];
        $query = Client::select('*');
        foreach($columns as $column)
        {
            $query->orWhere($column, 'LIKE', $findznach."%");
        }
        $client = $query->get();
        
        return view('Client.client_show', ['items'=>$client]);   
    }
    public function Del($id)
    {
        Client::find($id)->delete();
        return redirect()->route('clients.show_clients')->with('success','Сообщение было удалено');
    }
    

    public function updateClientStr($id){
        $client = new Client;
        return view('Client.client_update',['data'=>$client->find($id)]);
    }
    public function updateClient($id,Request $req)
    {
        /* dd($req->all()); */
        $validate=self::validator($req->all());
        if($validate->fails()){
            /* dd($validate->errors()); */
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $client=Client::find($id);
        
        $client->second_name = $req->input('second_name');
        $client->first_name = $req->input('first_name');
        $client->middle_name = $req->input('middle_name');
        $client->contacts_telephone = $req->input('contacts_telephone');
        $client->contacts_email = $req->input('contacts_email');
        $client->description = $req->input('description');
        $client->company_name = $req->input('company_name');
        $client->user_id = $req->user()->id;

        $client->save();
        
        return redirect()->route('clients.show_clients')->with('success','Сообщение было изменено');
    }

    

    public function create(Request $req)
    {
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
        return redirect()->route('clients.show_clients')->with('success','Сообщение было добавленно');
    }
    
}
