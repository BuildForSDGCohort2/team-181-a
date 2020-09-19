<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plantation extends Model
{
    protected $guarded=[];

    public function new_plantation(array $validated)
    {
        $new_plant = new Plantation;
        $new_plant->species= $validated['species'];
        $new_plant->type_id= $validated['type_id'];
        // conversion is needed.. also must check if the total is more than the total size of farmers farm...
        $new_plant->size_of_plantation= $validated['size'];
        $new_plant->user_id=  auth()->user()->id;
        $new_plant->planting_date= $validated['planting_date'];
        // $new_plant->default Status is not ready for harvest
        $new_plant->status=0;
        $new_plant->save();

    }
    #issue|recomendations| checker.. would use this object 

    public function farmer(){
        return $this->belongsTo('App\User');
    }
}
