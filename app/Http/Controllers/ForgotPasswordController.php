<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use ForgotsPasswords;

class ForgotPasswordController extends Controller
{
    

    // Redirect to the password reset request form
    public function showLinkRequestForm()
    {
        return view('auth.email');
    }

    // Send the password reset link
    public function sendResetLinkEmail(Request $request)
     {
    $this->validate($request, ['email' => 'required|email']);

    $response = $this->broker()->sendResetLink(
        $request->only('email')
    );

    if ($response === Password::RESET_LINK_SENT) {
        return back()->with('status', trans($response));
    } else {
        return back()->withErrors(['email' => trans($response)]);
    }
      }


    // Show the form to reset the password
    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }
    
    

    // Reset the user's password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:3',
        ]);

        $response = $this->broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
            ? redirect()->route('shopping.login')->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);

            
    }
    protected function resetPassword($user, $password)
    {
        // Update the user's password here
        $user->password = bcrypt($password);
        $user->save();
    }

    // Password broker to be used
    public function broker()
    {
        return Password::broker('students'); // Use the appropriate password broker
    }

    // Set the guard to use for password reset
    protected function guard()
    {
        return Auth::guard('student'); // Use the appropriate guard
    }
}
