<?php
namespace App\Http\Controllers;
use App\Animal_Fact_sheet;
use App\Plant_fact_sheet;
use App\User;
use App\Isues;
use DB;


trait UssdFactFinder
{
    public function fact_finder($information,$phone=null)
    {   
        $user = User::where('phone_number', $phone)->first();

        #0 ->added id if anml|plt|brd 1->cow|sheep|maize|beans 2->kienyeji|exotic 3->gender ,4->age approx|date
        $exploded_information= explode(',',$information);
        if ($exploded_information[0]=='anml' or $exploded_information[0]=='brood') {
           
            $animal_fact_sheet= Animal_Fact_sheet::where('breed',$exploded_information[2])->where('species',$exploded_information[1]);
            if (count(explode('-',$exploded_information[4]) )> 1) {
                $age_in_days = (abs(now()->diff(date_create($exploded_information[4]))->format('%R%a')));
            }else{
                $age_in_days= $exploded_information[4]*30 ;#convert the approx months to days
            }

            $regiments = DB::table('age_regiments')
                        ->where('species',$exploded_information[1])
                        ->where('age_limits','>=',$age_in_days)
                        ->orWhere('species','all')
                        ->where('age_limits','>=',$age_in_days)
                        ->get();
            if (count($regiments)==0) {
                return $this->custom_query_menu();
            } else {
                # code...
            }
            
        } else if($exploded_information[0] == 'plnt'){
            
            $plant_fact_sheet= Plant_fact_sheet::where('type',$exploded_information[2])->where('species',$exploded_information[1])->first();
            if (count(explode('-',$exploded_information[4]) )> 1) {
                $age_in_days = (abs(now()->diff(date_create($exploded_information[4]))->format('%R%a')));
            }else{
                $age_in_days= $exploded_information[4]*30 ;#convert the approx months to days
            }

            $regiments = DB::table('plant_dev_regiments')
                        ->where('species',$exploded_information[1])
                        ->orWhere('species','all')
                        ->where('age_limits','>=',$age_in_days)
                        ->get();
            
            if (count($regiments)==0 or $plant_fact_sheet==null) {
                return $this->custom_query_menu();
            } else {
                # code...
                $expected_produce = $plant_fact_sheet->production_rate*$exploded_information[3]; 
            }
            return $regiments;
            
        }else if ($exploded_information[0] == 'prof') {
            $role = $exploded_information[1];
            $wanted_proffesional = (User::role($exploded_information[1])->where('location',$exploded_information[2])->first());
            if ($wanted_proffesional == null) {
                Isues::create([
                    'reason'=>'Shortage',#rhe reason will carry the necesary data
                    'information'=>'There was a request for a '.ucfirst($exploded_information[1]).' Officer from '.$exploded_information[2].' by '.($user==null? $phone: $user->name.' '.$phone). '  there werent any available please find one and get Back To The Farmer.',
                    'status'=>0,
                    'user_id'=>1,
                    'identifier'=>'SHORTAGE'
                ]);
                $this->ussd_stop("There weren't any ".ucfirst($exploded_information[1]).'s Found in your area, The Admin will get back to you as soon as one is available.');

            } else {
                Isues::create([
                    'reason'=>'Summon',#rhe reason will carry the necesary data
                    'information'=>'Your Details have been shared to farmer'.$phone.' please Get in contact with the farmer.' ,
                    'status'=>0,
                    'user_id'=>$wanted_proffesional->id,
                    'identifier'=>'COTACTREQ'
                ]);
                #here we shall callm the sms trait
                Isues::create([
                    'reason'=>'Summon',#rhe reason will carry the necesary data
                    'information'=>'summmon' ,
                    'status'=>0,
                    'user_id'=>$wanted_proffesional->id,
                    'identifier'=>'SUMMON'
                ]);
                if ($role=='vet') {
                    $this->ussd_stop('A Vet Was found in your location. Dr '.ucfirst($wanted_proffesional->name).' Phone number '.$wanted_proffesional->phone_number.' has been alerted. His contacts have also been seent over to you for easier communication');

                }else {
                    $this->ussd_stop('Field Ext Officer '.ucfirst($wanted_proffesional->name).' Phone number '.$wanted_proffesional->phone_number.' has been alerted. His contacts have also been seent over to you for easier communication');
                }

            }
            
        }
        
    }
    public function regiment(Type $var = null)
    {
        # code...
    }
}
