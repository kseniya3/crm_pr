<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:15'],
            
        ]);
    }

    protected function Show()
    {
        $items = User::all();
        return view('User.user_show', ['items'=>$items]);
    }
    public function Del($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.show_user')->with('success','Сообщение было удалено');
    }
    public function updateUserStr($id){
        $user = new User;
        return view('User.user_update',['data'=>$user->find($id)]);
    }
    protected function updateUser(Request $req)
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
