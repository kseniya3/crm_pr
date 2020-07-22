<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('role');
    } */
    protected function validator(array $data)
    {
        return Validator::make($data,[
            'name' => ['required', 'string', 'max:30','alpha','unique:user'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:user'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:15'],

        ]);
    }
    protected function update_validator(array $data)
    {
        return Validator::make($data,[
            'name' => ['required', 'string', 'max:30','alpha'],
            'email' => ['required', 'string', 'email', 'max:30',],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:15'],

        ]);
    }

    protected function Show()
    {
        
        $items = User::all();
        return view('User.user_show', ['items'=>$items]);
    }
    protected function FindUser(Request $req)
    {

        $items = User::all();
        $findznach=$req->input('find');
        if($req->input('find')==""){
            return view('Client.client_show', ['items'=>$items]);
        }
        $columns = [
            'name', 'email', 'password', 'role',
        ];
        $query = User::select('*');
        foreach($columns as $column)
        {
            $query->orWhere($column, 'LIKE', $findznach."%");
        }
        $client = $query->get();

        return view('User.user_show', ['items'=>$client]);
    }
    public function Del($id)
    {
        $user=User::find($id);
        $client=$user->clients;
        foreach($client as $cl){
            $cl->user_id=null;
            $cl->save();
        }
        $deal=$user->deals;
        foreach($deal as $dl){
            $dl->user_id=null;
            $dl->save();
        }
        $comment=$user->comments;
        foreach($comment as $com){
            $com->user_id=null;
            $com->save();
        }
        
        
        $user->delete();
        return redirect()->route('users.show_user')->with('success','Сообщение было удалено');
    }
    public function updateUserStr($id){
        $user = new User;
        return view('User.user_update',['data'=>$user->find($id)]);
    }
    protected function updateUser($id,Request $req)
    {
        $validate=self::update_validator($req->all());
        if($validate->fails()){
            /* dd($validate->errors()); */
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $user=User::find($id);

            $user->name = $req->input('name');
            $user->email = $req->input('email');
            $user->password = Hash::make($req->input('password'));
            $user->role = $req->input('role');
            $user->save();
        return redirect()->route('users.show_user')->with('success','Сообщение было добавленно');
    }
    protected function create(Request $req)
    {
        $validate=self::validator($req->all());
        if($validate->fails()){
            /* dd($validate->errors()); */
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $user=new User;
        
            $user->name = $req->input('name');
            $user->email = $req->input('email');
            $user->password = Hash::make($req->input('password'));
            $user->role = $req->input('role');
            $user->save();
        return redirect()->route('users.show_user')->with('success','Сообщение было добавленно');
    }




}
