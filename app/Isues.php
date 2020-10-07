<?php

#this is the class where All the Messages and alerts are created
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;
class Isues extends Model

{

    protected $guarded=[];
    // make an isue
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
        if ($data->schedule_transport !== null) {
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
    public function in_transit_alert($order)
    {
        $this->create([
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



    public function delivery_alert($order)
    {
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

}
