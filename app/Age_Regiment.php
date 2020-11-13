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
        // echo ('running over  kshhht!');
        foreach (Age_Regiment::all() as $regiment) {
            $species = $regiment->species;
            $animals = DB::table('animals')
                        ->where('species','=',$species)
                        ->where('sale_status','=',0)->get();
            
            foreach ($animals as $animal) {               
                #The age is got in days since soome regiments will be given even to calf
                $age_in_days = (abs(now()->diff(date_create($animal->birthday))->format('%R%a')));
                $lower_age_limit = $regiment->age_limits - 100;#this is for testing purpoes
                $upper_age_limit =$regiment->age_limits + 1000000;
                if (($lower_age_limit <= $age_in_days) && ($age_in_days <= $upper_age_limit)) {

                    Isues::create([
                        'reason' => 'Animal Age Regiment',
            
                        'information' => 'Being '.floor(($age_in_days/28)).' months old '.ucfirst($animal->name). 'Needs a '.strtoupper($regiment->category).' that  will '.$regiment->tips,
                        'status' => 0 ,
                        'user_id' => $animal->user_id,
                        'identifier' => 'ANML-REG',   
                    ]);
                } 
               
            }

        }
    }
}
