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
    public function place_order()
    {
        #take into account the user could buy a specified amount
    }
    public function storage()
    {
        return $this->belongsTo('App\Storage');
    }
    public function animal()
    {
        return $this->belongsTo('App\Animal');
    }


}
