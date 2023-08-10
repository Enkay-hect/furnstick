<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Cast\Object_;

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
            'token' => $token
        ]);

        // ->where('created_at', '<=', now()->subMinutes(30)->toDateTimeString())
        // ->delete();

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

        $email_verified_at = $request->only('email_verified_at');


        $request->validate([
            'email' => 'required|email|string|exists:users',
            'password' => [
                'required'
            ],
            'remember' => 'boolean',
        ]);


        if (!Auth::attempt($request->only(['email','password', ]),
                $request->get('remember')))
            {
                return response([
                    'error' => 'Invalid credentials',
                ], 422);

            }


            // else if(User::where('email_verified_at', $email_verified_at)->first() !== 1){
            //     return response([
            //         'error' => 'User not verified',
            //     ], 422);
            // }


            if(User::where('email_verified_at', $email_verified_at)->first()){
                $user = Auth::user();
            }

        $user = Auth::user();

         /** @var \App\Models\MyUserModel $user **/
        $token = $user->createToken('main')->plainTextToken;


        return response([
            'user'=> $user,
            'token' => $token,
            //'is_verified' => $user->is_verified,
        ]);

    }



 /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function PasswordReset(Request $request)
    {

        $email = $request->only('email');


        if( $user =  User::where('email', $email)->first())
        {
            echo 'email exist';
            $tokenn = Str::random(32);

            PasswordReset::create([
                'user_id'=> $user->id,
                'email' => $user->email,
                'token' => $tokenn
            ]);

            Mail::send('email.passwordResetLink', ['token' => $tokenn], function($message) use($request){
                $message->to($request->email);
                $message->subject('');
            });
        } else {
            echo 'email does not exist';
        }



    }

}
