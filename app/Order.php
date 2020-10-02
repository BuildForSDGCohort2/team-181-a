<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    #cant wait to bite into this one
    public function create_order(Type $var = null)
    {
        # code...
    }

    public function get_orders()
    {   
        if (auth()->user()->hasRole('admin')) {
            return Order::all();           
        } else {
            return Order::where(['customer_id','=',auth()->user()->id]);
        }

    }
    public function user()
    {
       return  $this->belongsTo('App\User');
    }

}


