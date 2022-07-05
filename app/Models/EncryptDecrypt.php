<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncryptDecrypt extends Model
{

    /**
     * A method to decrypt a string.
     * 
     * @param string $string the string which should be decrypted.
     * @param string $key the key which should be used to decrypt the string.
     * 
     * @return string the decrypted string.
     */
    public static function decrypt($string_to_encrypt): string {
        $key = md5($key = getenv('ENCRYPTION_DECRYPTION_KEY'));
        $iv = substr( hash( 'sha256', "raaaannnnndddddoooooommmmmm" ), 0, 16 );
        $decryptedText = openssl_decrypt(base64_decode($string_to_encrypt), 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedText;
    }

    /**
     * A method to encrypt a string.
     * 
     * @param string $string_to_encrypt the string which should be encrypted.
     * @param string $key the key which should be used to encrypt the string.
     * 
     * @return string the encrypted string.
     */
    function encrypt($string_to_decrypt): string {
        $secretKey = md5($key = getenv('ENCRYPTION_DECRYPTION_KEY'));
        $iv = substr( hash( 'sha256', "raaaannnnndddddoooooommmmmm" ), 0, 16 );
        $encryptedText = openssl_encrypt($string_to_decrypt, 'AES-128-CBC', $secretKey, OPENSSL_RAW_DATA, $iv);
        return base64_encode($encryptedText);
    }


}
