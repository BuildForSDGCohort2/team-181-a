<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pregnant;
use App\Animal_Ailments;
use App\Animal;

class Waiting extends Model
{
    protected $guarded = [];

    public function insemination($id)
    {
        $waiting_animal = $this->find($id)->get();
        Pregnant::create([
            'pregnancy_status'=>0 ,#this is an unconfirmed pregnancy
            'pregnancy_date'=>date('Y-m-d'),
            'animal_id'=>$waiting_animal->animal_id,
            'user_id'=>$waiting_animal->proffesional_id
        ]);

    }
    public function sick()
    {
        
       $waiting_animal = $this->find($id)->get();
       Animal_Ailments::create([
           'animal_id'=>$waiting_animal->animal_id ,#this is an unconfirmed pregnancy
           'scale'=>0,
           'cause'=>$waiting_animal->animal_id,
           'vet_id'=>$waiting_animal->proffesional_id,
       ]);
 
    }
    public function cofirm_sale()
    {
        $waiting_animal = $this->find($id)->get();
        $animal = Animal::find($waiting_animal->animal_id);
        $animal->sale_status= 1;
        $animal->save();

    }

    public function well()
    {
        $this->delete();
    }

    public function proffesional()
    {
        return $this->belongsTo('App\User','proffesional_id');
    }
    public function animal()
    {
        return $this->belongsTo('App\Animal','animal_id');
    }
}
