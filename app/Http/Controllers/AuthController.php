<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
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

        ]);

        $data = $request->post();
        $createUser = $this->create($data);

        $token = Str::random(32);

        UserVerify::create([
            'user_id' => $createUser->id,
            'token' =>$token
        ]);

        Mail::send('email.emailVerification', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });

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

            ]);
    }

     /**
     * Write code on Method
     *
     * @return response()
     */

     public function verifyAccount($token)
     {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified';

        if(!is_null($verifyUser)){
            $user = $verifyUser->user;

            if(!$user->email_verified_at){
                $verifyUser->user->email_verified_at = Carbon::now();
                $verifyUser->user->is_verified = 1;
                $verifyUser->user->save();
               // $message = "Your e-mail is verified. You can now login.";
            }
            // else{
            //     $message = "Your e-mail is already verified. You can now login.";
            // }
        }

        return redirect('emailVerified')->with('message', $message);

     }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string|exists:users',
            'password' => [
                'required'
            ],
            'remember' => 'boolean',
        ]);


        if (!Auth::attempt($request->only(['email','password']),
                $request->get('remember'))){
                return response([
                    'error' => 'Invalid credentials',
                ], 422);

        }
        $user = Auth::user();


         /** @var \App\Models\MyUserModel $user **/
        $token = $user->createToken('main')->plainTextToken;


        return response([
            'user'=> $user,
            'token' => $token
        ]);

    }
}
