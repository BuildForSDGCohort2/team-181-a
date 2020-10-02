<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    protected $guarded = [];
    #cant wait to bite into this one
    public function create_order($data)
    {   
        $order = new Order;

        $order->sales_id = $data['product']->id;
        $order->product_identifier =$data['product']->prod_id;
        $order->order_status =0;
        $order->user_id = auth()->user()->id;
        $order->price = $data['product']->price * $data['quantity'];
        $order->type_of_delivery = $data['choice'];
        $order ->save();

        return ['quantity'=>$data['quantity'],'order'=>$order]; 
    }


    public function get_orders()
    {   
        if (auth()->user()->hasRole('admin')) {
            return $this->all();           
        } else {
            return $this->where(['customer_id','=',auth()->user()->id]);
        }

    }
    public function user()
    {
       return  $this->belongsTo('App\User');
    }
    public function sales()
    {
       return $this->belongsTo('App\Sales');
    }

}


