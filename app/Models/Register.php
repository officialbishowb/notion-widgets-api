<?php

namespace App\Models;

use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Register extends Model
{

    /**
     * A method the check if a email already exists in the database.
     * 
     * @param string $email the email given by the user.
     * 
     * @return bool true if the email exists, false if not.
     */
    public static function emailExist($email): bool{
        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            return true;
        } 
        return false;
    }

    /**
     * A method the check if a username already exists in the database.
     * 
     * @param string $username the username given by the user.
     * 
     * @return bool true if the username exists, false if not.
     */
    public static function usernameExist($username): bool{
        $user = DB::table('users')->where('username', $username)->first();
        if ($user) {
            return true;
        } 
        return false;
    }


    /**
     * A method to generate a token.
     * 
     * @return string the generated token.
     */
    public static function generateToken($size): string {
        return bin2hex(random_bytes($size));
    }


    /**
     * A method to register a user.
     * 
     * @param array $userData the data which should be inserted in the database.
     * 
     * @return bool true if the user is registered, false if not.
     */
    public static function registerUser($userData): bool{
        return DB::table('users')->insert($userData) ;
    }

    /**
     * A method to insert the api token.
     * 
     * @param array $apiData the api token data which should be inserted in the database.
     * 
     * @return bool true if the api token data is inserted, false if not.
     */
    public static function insertApiToken($apiData): bool{
        return DB::table('api_tokens')->insert($apiData);
    }


    /**
     * Add the email to unverified email table.
     * 
     * @param string $email the email which should be added to the table.
     * @param string $token the token which should be added to the table.
     */
    public static function addEmailToVerify($email, $token): bool{
        return DB::table('email_to_verify')->insert(['email' => $email, 'token' => $token]);
    }


    /**
     * Send email to the user to verify his email.
     * 
     * @param string $email the email of the user.
     * @param string $token the token to verify.
     */
    public static function sendVerifyEmail($email, $token): void{

        $to = $email;
        $verify_url = getenv('APP_URL') . '/verify_email?token=' . $token;


        Mail::to($to)->send(new VerifyMail($verify_url));
    
    }


    /**
     * A method to verify the email.
     * 
     * @param string $token the token which should be verified.
     * 
     * @return bool true if the email is verified, false if not.
     */

    public static function verifyEmail($token): bool{
        return DB::table('email_to_verify')->where('token', $token)->delete();
    }
}
