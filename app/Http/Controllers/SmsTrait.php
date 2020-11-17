<?php
namespace App\Http\Controllers;
use Twilio\Rest\Client;


use Exception;

trait SmsTrait
{
    
    public function sendText($message,$recipients=null)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $recipients = '+254768187628';

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, array('from' => $twilio_number, 'body' => $message));
    }
    
    
    

}



