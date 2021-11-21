<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Helper extends Controller
{
    public static function checkRecapctha($token)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];
        
        $result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".env('G_RECAPTCHA_SECRET_KEY')."&response=".$token."&remoteip=".$remoteip);
        $resultJson = json_decode($result);
       
        if( $resultJson->success != true ) {
            return false;
        } else {
            return true;
        }

        return false;
    }
}
