<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plant_fact_sheet extends Model
{
    public function plantations(){
        return $this->hasMany('App\Plantation');
    }
}
