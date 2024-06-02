<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    public function create(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        User::create(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]
        )->save();
        
        return response()->json(['message' => 'Account created successfully'], 201);
    }
    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user=User::where('email',$request->email)->first();
        if($user && Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Account Login successfully'], 201);
        }else{
            return response()->json(['message' => 'Account Login dosent successfully'], 505);
        }
        
    }
}
