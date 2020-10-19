<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Brood extends Model
{
    public function new_brood(array $validated)
    {
        $new_brood = new Brood;
        $new_brood->date_of_hatching = $validated['hatch_date'];
        $new_brood->user_id = auth()->user()->id;
        $new_brood->breed_id =(! is_null($validated['species'])) ? $validated['breed'] : 1 ;#one is an unknown ..
        $new_brood->species=$validated['species'];
        $new_brood->number =$validated['number'];
        $new_brood->gender = $validated['gender'];
        $new_brood->save();
    }
    public function deduct_number( $request)
    {
        $brood  = $this->find($request->id);
        $number = $request->birds_for_sell;
        $brood->number -= $number;
        $brood->save();
        return ['brood'=>$brood, 'number'=>$number,'price'=>($request->price === null? $brood->breed->price: $request->price)];
    }
    public function sell_bird(Array $data)
    {
        $number = ( $data['number'] === null ? 1 :$data['number']);
        if ($data['brood']->sales !==null ) {
            #get the sales record
            $sale_record = $data['brood']->sales;
            // return $data['brood'];
            $sale_record->amount += $number;
            $sale_record->price = $data['price'];
            $sale_record->save();
        } else {
            Sales::create([
                'prod_id'=>'POULT',
                'price'=>($data['price']),
                'amount'=>$number,
                'brood_id'=>$data['brood']->id,
            ]);
        }
    }

    public function breed(){
        return $this->belongsTo('App\Animal_Fact_sheet');
    }
    public function sales()
    {
      return $this->hasOne('App\Sales');
    }
    public function farmer(){
        return $this->belongsTo('App\User','id');
    }

}
