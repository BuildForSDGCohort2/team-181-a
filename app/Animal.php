<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $name;
    protected $species;
    protected $gender;
    protected $birthday;
    protected $weight;
    protected $reproductive_status;
    protected $health_status;
    protected $farmer_id;
    protected $breed_id;
    protected $mother_id;
    protected $father_id;
    protected $sale_status;
    public function __constructor($request)
    {
        # code...
    }
}
