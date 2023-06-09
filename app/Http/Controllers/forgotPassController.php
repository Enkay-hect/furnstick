<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class forgotPassController extends Controller
{
    /**
     *
     *
     *    @return
    */

    public function requestPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     *
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     public function storePassword (Request $request)
     {
        $request->validate([
            'email' => 'email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);
     }
}
