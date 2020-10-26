<?php
namespace App\Http\Controllers;
// require 'vendor/autoload.php';

use AfricasTalking\SDK\AfricasTalking;
use Exception;

trait SmsTrait
{
    public function sendText($message, $phone)
    {
        $username = "sandbox";
        $apiKey = "8369e29afcc85480172fee9c16a8267f3dab4e9bfaab01cb7565b092266c3fa7";

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
            return ;
        }

        return "I am done";
    }
}
