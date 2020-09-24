<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Storage;
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



    public function book_harvest()
    {
        $this->status= 1;# to be harvested
        $this->save();
    }
    public function harvest_plantation()
    {
        $this->status= 2;#harvested
        $this->size_of_plantation  = 0;#take  revoke the land it was under
        $this->save();
    }
    
    public function farmer(){
        return $this->belongsTo('App\User');
    }
    public function plant_fact_sheet(){
        return $this->belongsTo('App\Plant_fact_sheet','type_id');
    }
    public function storage()
    {
        return $this->hasOne('App\Storage','plantation_id');
    }
}
