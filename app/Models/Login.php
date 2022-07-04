<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Login extends Model
{

    /**
     * A method to check if a user exists in the database.
     * 
     * @param string $email the email given by the user.
     * @param string $password the password given by the user.
     * 
     * @return bool true if the user exists, false if not.
     */
    public static function validUser($email, $password):bool{
        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            if (password_verify($password, $user->password)) {
                return true;
            }
        }
        return false;
    }

    /**
     * A method to get the username of a user.
     * 
     * @param string $email the email given by the user.
     * 
     * @return string the username of the user.
     */
    public static function getUsername($email):string{
        $user = DB::table('users')->where('email', $email)->first();
        return $user->username;
    }


    /** 
     * Check if the user has verified his email.
     * 
     * @param string $email the email given by the user.
     */
    public static function emailIsVerified($email):bool{
        $user = DB::table('email_to_verify')->where('email', $email)->first();
        if ($user) {
            return false;
        }
        return true;
    }
   
}
