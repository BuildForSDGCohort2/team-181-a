<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregnant extends Model
{
    #Birth 
    #regiments


    public function animal()
    {
        return $this->belongsTo('App\Animal');
    }
    public function proffesional()
    {
        return $this->belongsTo('App\Proffesional');
    }
}
