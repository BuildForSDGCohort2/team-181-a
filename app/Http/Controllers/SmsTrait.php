<?php
namespace App\Http\Controllers;
// require 'vendor/autoload.php';
use Twilio\Rest\Client;

// use AfricasTalking\SDK\AfricasTalking;
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
    
    
    
    // public function sendText($message, $phone)
    // {


        

    //     $username = "sandbox";
    //     $apiKey = "8369e29afcc85480172fee9c16a8267f3dab4e9bfaab01cb7565b092266c3fa7";

    //     $AT = new AfricasTalking($username, $apiKey);

    //     $sms = $AT->sms();

    //     try {
    //         $result = $sms->send([
    //             'to'      => +254707777126,
    //             'message' => $message,
    //             'from'=> 'TF-ASISTANT'
    //         ]);

    //         print_r($result);
    //     } catch (Exception $e) {
    //         echo "Error: ".$e;
    //         return ;
    //     }

    //     return "I am done";
    // }
}



