<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
class UserController extends Controller
{
    public function index()
    {
        $users=User::all();
        return $users;
    }

    public function store(request $request)
    {
       $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:12',
            'confirm_password'=>'required|same:password',
        ]);
        //dd name

        $user = new User;
        $user->name=$request['name'];
        $user->email=$request['email'];
        $user->password=Hash::make($request['password']);
        $user->save();
       return response([
        'Message'=>'User added Successfully',
       ],200);
    }
    public function login(request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user=User::where('email',$request->email)->first();
        if($user && Hash::check($request->password,$user->password)){
            $token=$user->createToken($request->email)->plainTextToken;
            return response([
                'Message'=>'User login successfully',
                'Token'=>$token,
            ]);
        }else{
            return response([
                'Message'=>'Something went to wrong',
            ]);
        }

    }

}
