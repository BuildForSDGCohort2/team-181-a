<?php
namespace App\Http\Controllers;

use AfricasTalking\SDK\AfricasTalking;
use Exception;

trait SmsTrait
{
    public function sendText($message, $phone)
    {
        $username = config("nyasinga");
        $apiKey = config("be04161719b4822b5c96d912bfa39e87f457e4f086f917a2c9ce31a9aa266545");

        $AT = new AfricasTalking($username, $apiKey);

        $sms = $AT->sms();

        try {
            $result = $sms->send([
                'to'      => +254707777126,
                'message' => $message,
                'from'=> 'TF-ASISTANT'
            ]);

            print_r($result);
        } catch (Exception $e) {
            echo "Error: ".$e;
        }

        return "I am done";
    }
}
