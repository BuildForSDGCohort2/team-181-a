<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function new_enrolement(array $validated)
    {

        $sup = new Supplier;
        $sup->name = $validated['name'];
        $sup->email= $validated['email'];
        $sup->location= $validated['location'];
        #supus will be zero since he or she has not been vetted and given an account
        $sup->status=0;
        $sup->phone= $validated['phone_number'];
        #supe the one being registerd has never been rated before...
        $sup->ratings= 0;      
        if (array_key_exists('hardware',$validated) && array_key_exists('agrovet',$validated) ) {
            $sup->specialty = 'All';
        } else {
            $sup->specialty = (array_key_exists('hardware',$validated) ? 'Hardware' : 'Agrovet');
        }        
        $sup->transport =(array_key_exists('transport',$validated) ? 'Able' : 'Unable') ;
        $sup->ratings = 0;
        $sup->save();
    }
}
