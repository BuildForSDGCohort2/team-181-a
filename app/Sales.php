<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $guarded=[];
    public function get_product($request)
    {
        return $this->find($request->id);
    }
    public function process_order($request)
    {
        #take into account the user could buy a specified amount
        $prod = $this->find($request->id);

        if ($prod->prod_id !== "ANML"){
            #get the product off the market
            $prod->amount -= $request['quantity'];
            # plants and sacks they are sold out then thay become unavailable (status 1)
            if ($prod->amount === 0) {
                $prod->status= 1;
            }       
                        
        }else {
            #animals .. one animal one reciept
            $prod->status= 1;
        }
        
        $prod->save();
        $order_data = ['quantity'=>$request['quantity'] , 'choice'=>$request['choice'],'product'=>$prod];
        return  $order_data;

    }


    public function storage()
    {
        return $this->belongsTo('App\Storage');
    }
    public function animal()
    {
        return $this->belongsTo('App\Animal');
    }
    public function brood()
    {
        return $this->belongsTo('App\Brood');
    }
    public function orders()
    {
        return $this->hasMany('App\Order','prod_id');
    }



}
