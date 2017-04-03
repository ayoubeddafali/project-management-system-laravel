<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class usersController extends Controller
{
    public function profile($user_id){
        $user = User::find($user_id); 
        return view('users.profile',compact('user'));
    } 
    public function store(Request $request){
        if (is_null(Input::file('logo'))){

            //$fileName = "admin.png";
            $fileName = "admin.png";
        }else {
            $fileName = Input::file('logo')->getClientOriginalName();
            $destinationPath = 'img';
            Input::file('logo')->move($destinationPath, $fileName);
        }
        $request['logo'] = $fileName;
        $request['password'] = bcrypt($request->input('password'));
        User::create($request->input());
        return redirect('/admin/users');
    }
    public function create(){
        return view('users.create');
    }
    public function edit_profile($user_id){
        $user = User::find($user_id);
        return view('users.edit',compact('user'));

    }


    public function storeUser(Request $request , $user_id){
        if (is_null(Input::file('logo'))){

            $fileName = "admin.png";
        }else {
            $fileName = Input::file('logo')->getClientOriginalName();
            $destinationPath = 'img';
            Input::file('logo')->move($destinationPath, $fileName);
        }
        $data = $request->except(['password']);
        $user =  User::find($user_id);
        if ( ! $request->input('password') == '')
        {
            $request['password'] = bcrypt($request->input('password'));
        } else {
            $request['password'] = $user->password;
        }
        $request['logo'] = $fileName;
        $user->update($request->input());


          return redirect('/profile/'.$user_id);
    }
    public function delete($user_id){
        User::find($user_id)->delete();
        return redirect('/admin/users');
    }
  


}