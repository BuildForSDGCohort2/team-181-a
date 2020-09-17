<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal_Fact_sheet extends Model
{
    #I renamed during the development stages and so i have to Declare the new name. 
    protected $table="animal_fact_sheets";

    public function animal(){
        return $this->hasMany('App\Animal');
    }
}
