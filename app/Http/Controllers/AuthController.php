<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()
            ],
            'verification_code' => Str::random(64),
        ]);

        $data = $request->all();
        $verification_code = Str::random(64);
        $createUser = $this->create($data, $verification_code);
    }



        /**
         * Write code on Method
         *
         * @return response()
         */
        public function create(array $data)
        {
            // $verification_code = Str::random(64);

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'verification_code' => bcrypt(Str::random(64)),
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
