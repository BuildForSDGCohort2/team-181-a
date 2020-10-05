<?php

use Illuminate\Database\Seeder;

class PlantDevRegSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('plant_dev_regiments')->insert([
            'plant_id' =>2,
            'age_limits' =>21,
            'suppliment' =>'Urea',
            'tips' =>'Apply a HandFull Of Urea At The Base Of each Emerging Folliage on',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'plant_id' =>2,
            'age_limits' =>150,
            'suppliment' =>'Folliage Boster',
            'tips' =>'Be Sure to Purchase A booster,Read the instructions on the package  And Spray On',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'plant_id' =>1,
            'age_limits' =>180,
            'suppliment' =>'weeding',
            'tips' =>'Please make sure you weed',
            
        ]);
    }
}

