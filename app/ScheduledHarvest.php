<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduledHarvest extends Model
{
    
    public function plantation()
    {
        return $this->belongsTo('App\Plantation');
    }
    public function transporter()
    {
        return $this->belongsTo('App\User','transporter_id');
    }
}
