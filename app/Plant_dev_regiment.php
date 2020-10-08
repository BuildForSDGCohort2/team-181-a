<?php

namespace App;
use DB;
use App\Plantation;
use Illuminate\Database\Eloquent\Model;


#this clas will 'watch-over' the plantations as the develop to food... lert the farmer ... every step of the way
class Plant_dev_regiment extends Model
{
    public static function check()
    {
        foreach (Plant_dev_regiment::all() as $regiment) {
            $plant_id = $regiment->species;
            $plantations = Plantation::where('species',$species)->where('status',0)->get();

            foreach ($plantations as $plantation) {               
                #The age is got in days since soome regiments will be given even to plantation
                // $facts =  DB::table('plant_fact_sheets')
                //         ->where('id','=',$plantation->type_id)->get()[0];  
                
                $facts = $plantation->plant_fact_sheet;

                $age_in_days = abs(now()->diff(date_create($plantation->planting_date))->format('%R%a'));
                $lower_age_limit = $regiment->age_limits - 1000;
                $upper_age_limit =$regiment->age_limits + 1000;
                if (($lower_age_limit <= $age_in_days) && ($age_in_days <= $upper_age_limit)) {

                    Isues::create([
                        'reason' => 'Plantation Age Regiment',
            
                        'information' => $regiment->tips.' '.$plantation->species.' on the '.$plantation->size_of_plantation.'Acre Partition'  ,
                        'status' => 0 ,
                        'user_id' => $plantation->user_id,
                        'identifier' => 'PLT-REG',   
                    ]);
                }
                echo($facts->months_to_maturity);
                $plant_final_quatile = floor(($facts->months_to_maturity*28)*0.85);
                if ( $plant_final_quatile-2 <= $age_in_days && $age_in_days  <= $plant_final_quatile+ 7) { #these values are used so as to successflly test
                    Isues::plants_last_quatile_alert($plantation);
                }
                
            } 
        }
    }
}
