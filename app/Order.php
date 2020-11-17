<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Animal;
use App\Isues;
use DB;



class Order extends Model
{
    protected $guarded = [];
    #cant wait to bite into this one
    public function create_order($data)
    {

        if ($data['product']->prod_id== "ANML") {
            $product_information = $data['product']->animal;
        } elseif($data['product']->prod_id== "POULT") {
            $product_information =$data['product']->brood;
        }else {
            $product_information = $data['product']->storage->plantation;
        }
        $order = new Order;

        $order->sales_id = $data['product']->id;
        $order->product_identifier =$data['product']->prod_id;
        $order->order_status =0;
        $order->user_id = auth()->user()->id;
        $order->price = $data['product']->price * $data['quantity'];
        $order->type_of_delivery = $data['choice'];
        $order->seller_id = $product_information->farmer->id;
        #animal bug expected
        $order->quantity= $data['quantity'] ?? 1 ;
        $order ->save();

        return ['quantity'=>$data['quantity'],'order'=>$order];
    }

    public function get_orders()
    {
        if (auth()->user()->hasRole('admin')) {
            return $this->orderBy('created_at','desc')->get();
        } else {
            return $this->orderBy('created_at','desc')
                        ->where('user_id','=',auth()->user()->id)
                        ->orWhere('seller_id','=',auth()->user()->id)
                        ->get();
        }

    }

    public function dispatch_orders($location)
    {
        
        $orders =Order::where('order_status',0)->get()->filter(function($order) use($location){
            return $order->user->location == $location;
        });

        foreach ($orders as $order) {
            $this->transit($order->id);
            Isues::in_transit_alert($order);

        }
    }

    public function transit($order_id)
    {
        $order = $this->find($order_id);
        $order->order_status = 1;
        $order->save();
    }

    public function get_transit_orders()
    {
        $orders =Order::where('order_status',1)->get()->filter(function($order) {
            return $order->user->location == auth()->user()->location;
        });
        return $orders;
    }


    public function deliver($order_id)
    {
        $order = $this->find($order_id);
        #OR we could use soft delete
        $order->order_status = 2;
        $order->save;
    }

    public function get_deliverd_orders()
    {
        $orders =Order::where('order_status',2)->get()->filter(function($order) {
            return $order->user->location == auth()->user()->location;
        });
        return $orders;
    }

    public function user()
    {
       return  $this->belongsTo('App\User');
    }
    public function sales()
    {
       return $this->belongsTo('App\Sales');
    }
    public function get_seller($id)
    {
       $seller =  DB::table('users')
                    ->where('id','=',$id)
                    ->first();
        return $seller;
    }
    public function seller()
    {
        return $this->belongsTo('App\User','seller_id');
    }

}


