<?php
namespace App\Http\Controllers;


trait RegimentsTrait
{
    public function pass_regiments($regiments,$type)
    {
        if (count($regiments)==0) {
            $this->ussd_proceed("We found no Regiment Specific to animal \n you can however live a Query and a proffesional will get into it: ");
        } else {
            // $this->ussd_proceed('We found '.count($regiments).'  Specific to the animal entered.');
            // $message ="erghrhgiejbjeio";
            // $this->sendText($message, $phone);
            $message = "The ".ucfirst($type)." is viable for : \n";
            $comma_puncuator = 0;
            if (count($regiments )> 1) {
                foreach ($regiments as $regiment) {
                    $message .= ucfirst($regiment->suppliment);
                    if ($comma_puncuator== count($regiments)-1) {
                        $message .= ".";
                        break;
                    }
                    else if ($comma_puncuator < count($regiments)-2 ) {
                        $message .= ",\n";
                    }
                    else if(($comma_puncuator == count($regiments)-2)){
                        $message .= " and\n ";
                    }
                    $comma_puncuator +=1;
                    
                }
            }else {
                $message .=  ucfirst($regiment->suppliment).'.';
            }
            
            $message .= ' The Details have been sent Over to your phone.';
            $this->ussd_proceed($message);
        }
    }
}
