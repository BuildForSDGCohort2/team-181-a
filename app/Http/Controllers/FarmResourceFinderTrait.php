<?php
namespace App\Http\Controllers;
use App\Animal_Fact_sheet;
use App\Plant_fact_sheet;
use App\User;
use App\Isues;
use DB;


trait FarmResourceFinderTrait
{
    public function find_resource($phone,$info)
    {   
        $information = explode('-',$info);
        $user = User::where('phone_number', $phone)->first();
        switch ($information[0]) {
            case 'animal':
                $resource= 'animal';
                break;
            case 'plant'||'plantation'||'crop':
                $resource= 'plantations';
                break;
            case 'brood':
                $resource= 'brood';
                break;
            
            default:
                return $this->ussd_stop('We Could Not Find Such Resource.');
                break;
        }
        $resources = $user->$resource;

        if ($resources==null) {
            // $this->sms('pass the various ids and animal breeds', phone)
                $this->ussd_stop("There wasnt any ".ucfirst($resource)."s with that id registered under your name\n We have however sent over the Farm Resource ids registered under you \n cross-check and querry again.");
            }
            
        else {
            $required_resource = $resources->filter(function($resource)use($information){
                return $resource->id = $information[1];
                });
            // dd($required_resource);

            $this->ussd_stop("The Requested information about ".ucfirst($required_resource[0]->species.' Id number'.$required_resource[0]->id)." has been sent over, \n Always here For you, The Farmers Assistant. ");
        }
            
        
    }
    public function summon_proffesional($info , $phone)
    {   
        $user = User::where('phone_number', $phone)->first();
        $details = explode(',',$info);
        $res_details = array_shift($details); #this contains the resource id and also its kind
        $role = explode('-',$res_details)[0]=='plantation'?'feo':'vet';
        $wanted_proffesional = (User::role($role)->where('location',$user->location)->first());
        
        switch (explode('-',$res_details)[0]) {
            case 'animal':
                $resource = DB::table('animals')
                            ->where('id','=', explode('-',$res_details)[1])
                            ->where('user_id','=',$user->id)
                            ->get();
                break;
            
            case 'brood'|| 'poultry'||'chicken ':
                $resource = DB::table('broods')
                ->where('id','=', explode('-',$res_details)[1])
                ->where('user_id','=',$user->id)
                ->get();
                break;

            case 'plantation'||'plant':
                $resource = DB::table('plantations')
                    ->where('id','=', explode('-',$res_details)[1])
                    ->where('user_id','=',$user->id)
                    ->get();
                break;
            default:
                $this->ussd_stop("Please use : \n animal for Animal , plantation For Plantation or Brood for poultry .");

            break;
        }
        // dd($resource);
        #make a farnmers request
        if ( empty($resource ) ) {
            return $this->ussd_stop('There werent any resources Found matching the id provided');
        }
        if ($wanted_proffesional != null) {
            $message = 'Farmer '.ucfirst($user->name).' Phone number '.$phone.' would requested You to do';
            if (is_array($details)) {
                foreach ($details as $service) {
                    $message .= ucfirst($service);
                }
            } else {
                $message .= 'a '.$details;
            }
            $message.= ' on a '.ucfirst($resource[0]->species);
            Isues::create([
                'reason'=>'Summon',#rhe reason will carry the necesary data
                'information'=>$message ,
                'status'=>0,
                'user_id'=>$wanted_proffesional->id,
                'identifier'=>'SUMMON'
            ]);
            #here we shall callm the sms trait
            Isues::create([
                'reason'=>'Summon',#rhe reason will carry the necesary data
                'information'=>'A Vet Was found in your location. Dr '.ucfirst($wanted_proffesional->name).' Phone number '.$wanted_proffesional->phone_number.' has been alerted. His contacts have also been seent over to you for easier communication',
                'status'=>0,
                'user_id'=>$user->id,
                'identifier'=>'success'
            ]);
            if ($role=='vet') {
                $this->ussd_stop('A Vet Was found in your location. Dr '.ucfirst($wanted_proffesional->name).' Phone number '.$wanted_proffesional->phone_number.' has been alerted. His contacts have also been seent over to you for easier communication');

            }else {
                $this->ussd_stop('Field Ext Officer '.ucfirst($wanted_proffesional->name).' Phone number '.$wanted_proffesional->phone_number.' has been alerted. His contacts have also been seent over to you for easier communication');
            }         
            
        } else {
            Isues::create([
                'reason'=>'Shortage',#rhe reason will carry the necesary data
                'information'=>'There was a request for a '.ucfirst($role).' Officer from '.ucfirst($user->location).' by '.($user==null? $phone: $user->name.' '.$phone). '  there werent any available please find one and get Back To The Farmer.',
                'status'=>0,
                'user_id'=>1,
                'identifier'=>'SHORTAGE'
            ]);
            $this->ussd_stop("There weren't any ".ucfirst($role).'s Found in your area, The Admin will get back to you as soon as one is available.');
        }
        


        
    }
}