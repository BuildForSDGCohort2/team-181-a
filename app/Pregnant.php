<?php

namespace App;
use DB;
use App\Animal_Fact_sheet;
use App\Animal;
use App\Isues;

use Illuminate\Database\Eloquent\Model;

class Pregnant extends Model
{
    public function pregnancy_watcher()
    {
        $gestation  = Animal_Fact_sheet::find($this->animal_id)->gestation_period;
        if ($this->status == 0) {
            # call the vet to come confirm the birth or remind the farmer get a farmer com check the animal out
            #check if the animal has a vet assighned to it
            Isues::confirm_pregnancy($this);
            
        } else {
            # now to check for the interquatile

            $pregnancy_period = abs(now()->diff(date_create($this->animal->birthday))->format('%R%a'));
            $quatile = $gestation/4;
            if ($pregnancy_period== $quatile) {
               $quatile_value  = 1;
            }elseif ($pregnancy_period== $quatile * 2) {
                $quatile_value  = 2;
            }elseif ($pregnancy_period== $quatile * 3) {
                $quatile_value  = 3;
            }elseif ($pregnancy_period== $gestation && $pregancy->status != 2) {
                $quatile_value  = 4;
            }
            Isues::quatile_alert([$quatile_value,$this]);
        }
         
    }
    
    protected $guarded=[];
    #Birth 
    #regiments
    public static function new_pregnancy(Type $var = null)
    {
        # code...
    }
    
    public function confirm_pregnancy($animal)
    {   #eloquent would be advisable
        $pregancy = DB::table('pregnants')
                    ->where('animal_id','=',$animal->id)
                    ->where('status','=',0)
                    ->get();

    }
    
    public function animal()
    {
        return $this->belongsTo('App\Animal');
    }
    public function proffesional()
    {
        return $this->belongsTo('App\Proffesional');
    }
}
