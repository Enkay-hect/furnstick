<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
// use Illuminate\Support\Facades\Password;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()
                //->numbers()->symbols()
                //this will require number and symbol in the password...
            ]
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user'=> $user,
            'token' => $token
        ]);
    }




    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string|exists:users',
            'password' => [
                'required'
            ],
            'remember' => 'boolean'
        ]);


        if(!Auth::attempt($request->only(['email','password']), $request->get('remember'))){
            return response([
                'error' => 'Invalid password',
            ], 422);

        }
        $user = Auth::user();

        // $user = Auth::loginUsingId(1);

        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user'=> $user,
            'token' => $token
        ]);

    }

}
