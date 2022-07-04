<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{

    /**
     * A method to login a user.
     */
    public function loginUser(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        if(Login::validUser($email, $password)){
            // Only if the user has verified his email, create a session with the username
            if(Login::emailIsVerified($email)){
                session()->put('username_', Login::getUsername($email));
                return redirect('/dashboard');
            }else{
                return redirect()->back()->with('login_error', 'You have to verify your email first');
            }
            
        }
        return redirect()->back()->with('login_error', 'Invalid email or password!');
    }
}
