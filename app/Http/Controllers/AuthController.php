<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;

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
        $createUser = $this->create($data);

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
                'verification_code' => bcrypt(Str::random(32)),
            ]);


            Mail::send('mail.confirmEmail', $data,
            function ($message) {
                        $message->to('john@johndoe.com', 'John Doe');
                        $message->subject('Click to Verify Email');
            });
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
                'error' => 'Invalid credentials',
            ], 422);

        }
        $user = Auth::user();


        $token = $user->createToken('main')->plainTextToken;


        return response([
            'user'=> $user,
            'token' => $token
        ]);

    }
}
