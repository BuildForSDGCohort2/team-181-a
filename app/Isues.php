<?php

#this is the class where All the Messages and alerts are created
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;
use App\Waiting;
class Isues extends Model

{

    protected $guarded=[];
    // make an isue
    public function origin($order)
    {
       return $origin =($order->sales->prod_id=== 'ANML'?$order->sales->animal:
        ($order->sales->prod_id === 'POULT'? $order->sales->brood:
        ($order->sales->storage->plantation)));
    }

    public function generate_issue(array $isues)
    {
        $new_issue = new Issues;
        $new_issue->reason = $isues[''];
        $new_issue->information = $isues['information'];
        $new_issue->status = 0;
        $new_issue->user_id = $isues['user_id'];
        $new_issue->save();
    }

    public function issues()
    {
        return DB::table('isues')
                ->where('user_id','=',auth()->user()->id)
                ->get();
    }
    public function get_unsolved_issues()
    {
        return DB::table('isues')
                ->where('user_id','=',auth()->user()->id)
                ->where('status','=',0)
                ->orWhere('user_id','=',null)
                ->orderBy('created_at','DESC')
                ->paginate();
        // return Isues::where(['user_id','=',auth()->user()->id],['status','=',0]);
    }
    public function make_harvest_reminder( $data)
    {
        $identifier = 'RMNDR-HVST-PLT-'.$data->id.'-'.($data->schedule_transport === null? null :'T');
        Isues::create([
            'reason'=>'Harvest Reminder',
            'information'=>'You Scheduled a Harvest  ',
            'user_id'=> auth()->user()->id,
            'identifier'=>$identifier,
            'status'=>0,
            'due_date'=> $data->scheduled_date,
        ]);
        if ($data->schedule_transport != null) {

            Isues::create([
                'reason'=>'Transport Request',
                'information'=>'Transport Will be Dispatched to '. auth()->user()->name(). 'For Harvesting on '. $data->scheduled_date,
                'user_id'=> 1,
                'identifier'=>'TRANSP-REQUEST',
                'status'=>0,
                'due_date'=> $data->scheduled_date,
            ]);
        }
    }
    #alert the Farmer The farm is almost ready for harvest
    public static function plants_last_quatile_alert($plantation)
    {

        Isues::create([
            'reason'=>'Reminder To schedule Harvest',
            'information'=>'The Plantation number: '.$plantation->id.' is '.(abs($plantation->time_to_harvest())).
                            ' days away From harvest it Would be advisable to Start all necessary preparations',
            'user_id'=> 1,
            'identifier'=>'HRVST-RMNDER',
            'status'=>0,
            'due_date'=> null,
        ]);
    }


    public function order_alert($data)
    {
        $order = $data['order'];
        $origin =($order->sales->prod_id=== 'ANML'?$order->sales->animal:
                    ($order->sales->prod_id === 'POULT'? $order->sales->brood:
                    ($order->sales->storage->plantation)));

        $this->create([
            'reason' => 'Sale ',
            'information' => 'Sale Of '.($order->sales->prod_id=== 'ANML'?$origin->name.'( The '. $origin->species.')':
                            ($order->sales->prod_id === 'POULT'?$data['quantity'].' '. $origin->species: $data['quantity'].
                            ($order->sales->prod_id=== 'PLT'? 'Sacks Of'.$origin->species:''))),
            'status' => 0 ,
            'user_id' => $origin->farmer->id,
            'identifier' => 'SALE-'.$data['order']->id,

        ]);
        $this->create([
            'reason' => $order->type_of_delivery=== 'pick'? 'Ferrying': 'Home',

            'information' => 'Ferrying  Of '.($order->sales->prod_id=== 'ANML'?$origin->name.'( The '. $origin->species.')':
                ($order->sales->prod_id === 'POULT'?$data['quantity'].' '. $origin->species:
                ($order->sales->prod_id=== 'PLT'? 'Sacks Of'.$origin->species:''))).'to ' .$order->user->location,
            'status' => 0 ,
            'user_id' => 1,
            'identifier' => ($order->type_of_delivery=== 'pick'? 'STATION': 'HME').'-DEL',
        ]);




    }
    public static function in_transit_alert($order)
    {
        $origin =($order->sales->prod_id=== 'ANML'?$order->sales->animal:
        ($order->sales->prod_id === 'POULT'? $order->sales->brood:
        ($order->sales->storage->plantation)));

       Isues::create([
            'reason' => 'Order Transit',

            'information' => 'Your Order  Of '.($order->sales->prod_id=== 'ANML'?$origin->name.'( The '. $origin->species.')':
                ($order->sales->prod_id === 'POULT'?$data['quantity'].' '. $origin->species:
                ($order->sales->prod_id=== 'PLT'? 'Sacks Of'.$origin->species:''))).'is in Transit',
            'status' => 0 ,
            'user_id' => $order->user_id,
            'identifier' => 'TRANSIT',
        ]);
    }

    public static function confirm_pregnancy($pregnancy)
    {
        $animal = $pregnancy->animal;

        if ($pregnancy->user_id == null) {
            Isues::create([
                'reason'=>'Pregnancy Status Confirmation',
                'information'=>'Please Summon A vet To confirm on '.($animal->name)."'s Pregnancy Status",
                'status'=>0,
                'user_id'=>$animal->user_id,
                'identifier'=>'PREG-CONF'
            ]);
        } else {
            Isues::create([
                'reason'=>'Pregnancy Status Confirmation',
                'information'=>'Please Confirm the Pregnancy Status of '.($animal->name)."'s Pregnancy Status",
                'status'=>0,
                'user_id'=>$pregnancy->user_id,
                'identifier'=>'PREG-CONF'
            ]);
        }



    }

    public function quatile_alert($pregnancy)
    {
        Isues::create([
            'reason'=>'Pregnancy Status Confirmation',
            'information'=>'The '.(($pregnancy[0]==1 ? 'First':$pregnancy[0]==2 )?'Second':($pregnancy[0]==3 ?'Third And Final':'Extra'))
            .($pregnancy[0] != 4?'quartile of '.($pregnancy[1]->animal->name)."'s Pregnancy Status. Check up On the animal.":
             'Time The Baby is due at any moment please Go check And assis '.($pregnancy[1]->animal->name)),
            'status'=>0,
            'user_id'=>$pregnancy->user_id,
            'identifier'=>'PREG-CHCK'
        ]);
        Isues::create([
            'reason'=>'Pregnancy Status Confirmation',
            'information'=>'The '.(($pregnancy[0]==1 ? 'First':$pregnancy[0]==2) ?'Second':($pregnancy[0]==3 ?'Third And Final':'Extra'))
                            .($pregnancy[0] != 4?'quartile of '.($pregnancy[1]->animal->name)."'s Pregnancy Status. Check up On the animal.":
                             'Time The Baby is due at any moment please isolate '.($pregnancy[1]->animal->name).'from the others'),
            'status'=>0,
            'user_id'=>$pregnancy->animal->user_id,
            'identifier'=>'PREG-CHCK'
        ]);
    }
    public static function alert_proffesional($id,$request)
    {
        return [$id,$request];
        if ($id === 0) {
            Isues::create([
                'reason'=>'Shortage',#rhe reason will carry the necesary data
                'information'=>'There was a request for a Veterinary Officer from'.ucfirst(auth()->user()->location).' by '.auth()->user()->name.' '.auth()->user()->phone_number.' there werent any available please find one and get Back To The Farmer.',
                'status'=>0,
                'user_id'=>1,
                'identifier'=>'SHORTAGE'
            ]);

            Isues::create([
                'reason'=>'Delay',#rhe reason will carry the necesary data
                'information'=>"There were'nt any Verinary Officers found in your area, however one is being organised for you by the admin. Sit tight, sorry for ant incoviniences encountered",
                'status'=>0,
                'user_id'=>auth()->user()->id,
                'identifier'=>'REGRET'
            ]);

        } else {
            #here youll debug 
            #the checkboxes should generate automatic maseages.
            #checkboxes wuill be much easier for the user to input <queries class=""></queries>
            #add a other | other reason input area..
            $proffesional = User::find($id);
            $reason = 'Dear '.ucfirst($proffesional->name).' your attention is required By '.ucfirst (auth()->user()->name).' Phone number '.(auth()->user()->phone_number).' to: '; 
                #checked Reasons
                $checks = '';
                #code to store in the waiting table , the code that will help the system know how to handle the record
                $code  = null;
                if ($request->checkup == 'true') {
                    $checks.=' A Health Checkup';
                    $code ='chkup';

                } 
                if ($request->sell=='true') {
                    $checks.=' A Sales Check';
                    $code =$code==null? 'sale': $code.'-sale';
                }
                if ($request->injury=='true') {
                    $checks.=' An injury Checkup ';
                    $code =$code==null? 'ij': $code.'-ij';
                }
                if ($request->ainsemination=='true') {
                    $checks.=' An Artificial insemination Procedure ';
                    $code =$code==null? 'ai': $code.'-ai';
                }
                

            
            Isues::create([
                'reason'=>'Summon',#rhe reason will carry the necesary data
                'information'=>$reason.$checks.' on a ' .ucfirst($request->gender).' '.ucfirst($request->species) ,
                'status'=>0,
                'user_id'=>$id,
                'identifier'=>'SUMMON'
            ]);

            Waiting::create([
                'service'=>$code,
                'proffesional_id'=>$id,
                'animal_id'=>$request->id,
            ]);
            
            Isues::create([
                'reason'=>'Success',#rhe reason will carry the necesary data
                'information'=>"Your Reqest For a Vet was Successfull and Dr. ".ucfirst(User::find($id)->name).' phone number '.User::find($id)->phone_number.' will Get it Contact with You.' ,
                'status'=>0, 
                'user_id'=>auth()->user()->id,
                'identifier'=>'Vet Enroute'
            ]);
        }


    }
    public function alert_supplier($id,$request)
    {
        if ($id === 0) {
            Isues::create([
                'reason'=>'Shortage',#rhe reason will carry the necesary data
                'information'=>'There was a request for  '.strtoupper($request->regiment).'from'.ucfirst(auth()->user()->location).' by '.auth()->user()->name.' '.auth()->user()->phone_number.'there werent any available please find on',
                'status'=>0,
                'user_id'=>1,
                'identifier'=>'SHORTAGE'
            ]);

            Isues::create([
                'reason'=>'Delay',#rhe reason will carry the necesary data
                'information'=>"There were'nt any  suppliers selling ".strtoupper($request->regiment)." found in your area, however one is being organised for you by the admin. Sit tight sorry for ant incoviniences encountered",
                'status'=>0,
                'user_id'=>auth()->user()->id,
                'identifier'=>'REGRET'
            ]);

        } else {
            Isues::create([
                'reason'=>'Regiment',#rhe reason will carry the necesary data
                'information'=>ucfirst(auth()->user()->name).' '.ucfirst(auth()->user()->phone_number).' would like '.$request->regiment->suppliment.' contact an avail the necessary regiment',
                'status'=>0,
                'user_id'=>$id,
                'identifier'=>$information['identifier']
            ]);
            Isues::create([
                'reason'=>'Success',#rhe reason will carry the necesary data
                'information'=>"Your Request Was Successfully Submitted to Supplier : ".User::find($id)->name. 'Phone number '.User::find($id)->phone_number ,
                'status'=>0,
                'user_id'=>auth()->user()->id,
                'identifier'=>'SUCCESS'
            ]);
        }


    }
    public function alert_transporter($id,$request)
    {

        if ($id === 0) {
            Isues::create([
                'reason'=>'Shortage',#rhe reason will carry the necesary data
                'information'=>'There was a request for Transport  from'.ucfirst(auth()->user()->location).' by '.auth()->user()->name.' '.auth()->user()->phone_number.' transporters available please find one and get Back To The Farmer.',
                'status'=>0,
                'user_id'=>1,
                'identifier'=>'SHORTAGE'
            ]);

            Isues::create([
                'reason'=>'Delay',#rhe reason will carry the necesary data
                'information'=>"There were'nt any Transporterss found in your area, however one is being organised for you by the admin. Sit tight, sorry for ant incoviniences encountered",
                'status'=>0,
                'user_id'=>auth()->user()->id,
                'identifier'=>'REGRET'
            ]);

        } else {
            #here youll debug 
            #the checkboxes should generate automatic maseages.
            #checkboxes wuill be much easier for the user to input <queries class=""></queries>
            #add a other | other reason input area..
            $transporter = User::find($id);
            $reason = 'Dear '.ucfirst($transporter->name).' your Transport Services are needed By '.ucfirst (auth()->user()->name).' Phone number '.(auth()->user()->phone_number).' to: '; 
                #checked Reasons
                #need the plantstion data
               

            
            Isues::create([
                'reason'=>'Summon',#rhe reason will carry the necesary data
                'information'=>$reason.$checks.' on a ' .ucfirst($request->gender).' '.ucfirst($request->species) ,
                'status'=>0,
                'user_id'=>$id,
                'identifier'=>'Transport'
            ]);

            ScheduledHarvest::create([
                'date'=>'',
                'plantation_id'=>'',
                'transporter'=>'',
            ]);
            
            Isues::create([
                'reason'=>'Success',#rhe reason will carry the necesary data
                'information'=>"Your Reqest For a Vet was Successfull and Dr. ".ucfirst(User::find($id)->name).' phone number '.User::find($id)->phone_number.' will Get it Contact with You.' ,
                'status'=>0, 
                'user_id'=>auth()->user()->id,
                'identifier'=>'Vet Enroute'
            ]);
        }


    }

    


    public function delivery_alert($order)
    {
        $origin =($order->sales->prod_id=== 'ANML'?$order->sales->animal:
                ($order->sales->prod_id === 'POULT'? $order->sales->brood:
                ($order->sales->storage->plantation)));

        $this->create([
            'reason' => 'Order Delivered',

            'information' => 'Your Order  Of '.($order->sales->prod_id=== 'ANML'?$origin->name.'( The '. $origin->species.')':
                ($order->sales->prod_id === 'POULT'?$data['quantity'].' '. $origin->species:
                ($order->sales->prod_id=== 'PLT'? 'Sacks Of'.$origin->species:''))).'Has Been Delivered',
            'status' => 0 ,
            'user_id' => $order->user_id,
            'identifier' => 'DELIVERY',
        ]);

    }

    public function get_issue($id) {
        return Isues::where('id','=',$id)->first();
    }
    public function read($request)
    {
        $issue = $this->find($request->id);
        $issue->status = 1;
        $issue->save();
    }

}
