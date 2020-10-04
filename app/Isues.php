<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;
class Isues extends Model

{

    protected $guarded=[];
    
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
                ->get();
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
            'user_id' => User::get_available('supplier',$origin->farmer->location),
            'identifier' => ($order->type_of_delivery=== 'pick'? 'STATION': 'HME').'-DEL',     
        ]);
       



    }
    public function issue_classifier(Type $var = null)
    {
        #This will get to classifie various isues or reminders the the user 
        #will bee geting maybe automatically generated or from the other users
        #ANM- this wll be a n animal issue identifier
        #PLNT- will be for plantation
        #POULT- will be a poultry 
        #INF- This will be information needed to complete ones profile in the system  
    }

}
