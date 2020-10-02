<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use App\Sales;
use App\Plantation;

class Storage extends Model
{
    protected $guarded=[];
    
    public function store($data)
    {   
        
        $new_prod = $this->create([
            'sacks'=>$data->sacks-$data->amount,
            'plantation_id'=>$data->id,
        ]);

        if ($data->sell !==null  ) {
            Sales::create([
                'prod_id'=>'PLT',
                'price'=>($data->price===null?Plantation::find($data->id)->plant_fact_sheet->price_per_bag:$data->price),
                'amount'=>($data->amount===null?$this->find($data->id)->sacks:$data->amount),
                'storage_id'=> $new_prod->id,
            ]);
        }

    }

    #this will decrement the number of sacks while selling
    public function decrement_sacks($request)
    {
        $stored =$this->where('id','=',$request->id)->get()[0];

        if ($stored->sacks < $request['sacks_for_sale'] ) {
            throw ValidationException::withMessages(['Amount' => 'Number of sacks Should be less than those in storage']);
        }elseif(property_exists($request,'all')){
            $stored->sacks = 0;
            $stored->save();
        }else {
            # code...        
            $stored->sacks = ($stored->sacks)-$request['sacks_for_sale']; #should return errror if number of sacks to sell is more than the ones to be deducted
            $stored->save();
      }
    }

    public function sell_crop_produce($data)
    {
        $stored =$this->where('id','=',$data->id)->get()[0];

        if ($stored->sales !== null ) {
            $sales = $stored->sales;
            $sales->amount +=  $data->sacks_for_sale;
            $sales->price = ($data->price===null?$sales->price:$data->price);
            $sales->save();
        }else {
            Sales::create([
            'prod_id'=>'PLT',
            'price'=>($data->price===null? $this->find($data->id)->plantation->plant_fact_sheet->price_per_bag:$data->price),
            'amount'=>($data->sacks_for_sale===null?$this->find($data->id)->sacks:$data->sacks_for_sale),
            'storage_id'=> $data->id,
        ]);
        }

    }

    
    public function for_sale()
    {
        return $this->where('status','=',2);
    }
    
    public function plantation()
    {
        return $this->belongsTo('App\Plantation');
    }
    public function sales()
    {
        return $this->hasOne('App\Sales');
    }


}
