<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brood extends Model
{
    public function new_brood(array $validated)
    {
        $new_brood = new Brood;
        $new_brood->date_of_hatching = $validated['hatch_date'];
        $new_brood->number = $validated['number'];
        $new_brood->gender = $validated['gender'];
        $new_brood->user_id = auth()->user()->id;
        $new_brood->breed_id =(! is_null($validated['species'])) ? $validated['breed'] : 1 ;#one is an unknown ..
        $new_brood->species=$validated['species'];
        $new_brood->save();
    }
}
