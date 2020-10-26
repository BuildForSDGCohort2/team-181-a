<?php
namespace App\Http\Controllers;

use AfricasTalking\SDK\AfricasTalking;
use Exception;

trait SmsTrait
{
    public function sendText($message, $phone)
    {
        $username = config("africastalking.Nyasinga_sandbox");
        $apiKey = config("africastalking.c4b77ef5eed1b4b0c3b77ca6798ff59f8692ed83af6d534eccc4b83a09dc4d38");

        $AT = new AfricasTalking($username, $apiKey);

        $sms = $AT->sms();

        try {
            $result = $sms->send([
                'to'      => $phone,
                'message' => $message,
                'from'=> 'TF-ASISTANT'
            ]);

            print_r($result);
        } catch (Exception $e) {
            // echo "Error: ".$e.getMessage();
        }

        return "I am done";
    }
}
