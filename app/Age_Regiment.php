<?php

namespace App;
use DB;
use App\Animal_Fact_Sheet;
use App\Isues;

use Illuminate\Database\Eloquent\Model;

class Age_Regiment extends Model
{
    protected $table="age_regiments";

    public static function check()
    {
        foreach (Age_Regiment::all() as $regiment) {
            $breed_id = $regiment->breed_id;
            $animals = DB::table('animals')
                        ->where('breed_id','=',$breed_id)
                        ->where('sale_status','=',0)->get();
            foreach ($animals as $animal) {               
                #The age is got in days since soome regiments will be given even to calf
                $age_in_days = abs(now()->diff(date_create($animal->birthday))->format('%R%a'));
                $lower_age_limit = $regiment->age_limits - 100;
                $upper_age_limit =$regiment->age_limits + 1000000;
                if (($lower_age_limit <= $age_in_days) && ($age_in_days <= $upper_age_limit)) {

                    Isues::create([
                        'reason' => 'Animal Age Regiment',
            
                        'information' => 'Being'.($age_in_days/28).' months old'.$animal->name.'Needs a '.$regiment->category.' that You will '.$regiment->tips,
                        'status' => 0 ,
                        'user_id' => $animal->user_id,
                        'identifier' => 'ANML-REG',   
                    ]);
                }
                
            } 
        }
    }
}
