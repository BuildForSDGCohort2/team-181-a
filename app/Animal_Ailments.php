<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Model;

class Animal_Ailments extends Model
{   
    use SoftDeletes;
    public function animal()
    {
        return $this->belongsTo('App\Animal');
    }
    public function vet()
    {
        return $this->belongsTo('App\User','vet_id');
    }
}
