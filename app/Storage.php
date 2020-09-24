<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sales;
use App\Plantation;

class Storage extends Model
{
    protected $guarded=[];
    
    public function store($data)
    {   
        if ($data->sell !==null  ) {
            Sales::create([
                'prod_id'=>'PLA-'.$data->id,
                'price'=>($data->price===null?Plantation::find($data->id)->plant_fact_sheet->price_per_bag:$data->price),
                'amount'=>($data->amount===null?$data->sack:$data->amount),
            ]);
        }
        $this->create([
            'sacks'=>$data->sacks,
            'plantation_id'=>$data->id,
            'sale_status'=>($data->sell === null?0:1),
        ]);
    }

    
    public function for_sale()
    {
        return $this->where('status','=',2);
    }
    
    public function plantation()
    {
        return $this->belongsTo('App\Plantation');
    }
    #a product must always belong to a farmer

}
