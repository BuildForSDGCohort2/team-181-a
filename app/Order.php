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
            return $this->orderBy('created_at','desc');           
        } else {
            return $this->orderBy('created_at','desc')
                        ->where('user_id','=',auth()->user()->id)
                        ->orWhere('seller_id','=',auth()->user()->id)
                        ->get();
        }

    }
    public function transit($order_id)
    {
        $order = $this->find($order_id);
        $order->order_status = 1;
        $order->save();
        return $order;
    }
    public function deliver($order_id)
    {
        $order = $this->find($order_id);
        #OR we could use soft delete
        $order->order_status = 2;
        $order->save;
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

}


