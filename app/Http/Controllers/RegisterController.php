<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;

class RegisterController extends Controller
{

    /**
     * A method to register a user.
     */
    public function registerUser(Request $request){

        # Get all the data from the request and generate a token
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $name = $request->input('full_name');
        $token = Register::generateToken(18);


        # Check if the username or email already exist
        $usernameExist = Register::usernameExist($username);
        $emailExist = Register::emailExist($email);


        if($usernameExist || $emailExist){
            return redirect()->back()->with('register_error', 'Username or email already exist');
        }

        # If the username or email doesn't exist, create a new user
        $userData = [
            'username' => $username,
            'full_name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'api_token' => $token,
        ];

        $apiData = [
            "token" => $token,
            'username' => $username,
        ];

        $register = Register::registerUser($userData);
        if($register){
            # If the user is registered, insert the api token in the database
            Register::insertApiToken($apiData);
            $verify_email_token = sha1($username.$token.$email);
            Register::addEmailToVerify($email, $verify_email_token);
            Register::sendVerifyEmail($email, $verify_email_token);

            return redirect('/login');
        }else{
            return redirect()->back()->with('register_error', 'Something went wrong');
        }
    }

    /**
     * A method to verify the email.
     * 
     * @param string $token the token which was sent to the user.
     */
    public function verifyEmail($token):bool{
        return Register::verifyEmail($token);
    }
}
