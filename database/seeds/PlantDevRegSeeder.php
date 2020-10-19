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
            'species' =>'all',
            'age_limits' =>7,
            'suppliment' =>'Urea',
            'tips' =>'Apply a HandFull Of Urea At The Base Of each Emerging Folliage on',
            
        ]);

        DB::table('plant_dev_regiments')->insert([
            'species' =>'all',
            'age_limits' =>7,
            'suppliment' =>'Urea',
            'tips' =>'Apply a HandFull Of Urea At The Base Of each Emerging Folliage on',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'maize',
            'age_limits' =>21,
            'suppliment' =>'Urea',
            'tips' =>'Apply a HandFull Of Urea At The Base Of each Emerging Folliage on',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'maize',
            'age_limits' =>21,
            'suppliment' =>'insecticide',
            'tips' =>'apply insecticede on the emerging dhoot to prevent pests such as army worms on',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'beans',
            'age_limits' =>21,
            'suppliment' =>'insecticide',
            'tips' =>'apply insecticede on the emerging dhoot to prevent pests such as army worms on',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'maize',
            'age_limits' =>49,
            'suppliment' =>'insecticide',
            'tips' =>'apply insecticede on the emerging dhoot to prevent pests such as army worms on',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'maize',
            'age_limits' =>49,
            'suppliment' =>'npk',
            'tips' =>'administer npk on ',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'maize',
            'age_limits' =>70,
            'suppliment' =>'desease controll',
            'tips' =>'to prevent brown spot disease we suggest you apply',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'wheat',
            'age_limits' =>70,
            'suppliment' =>'desease controll',
            'tips' =>'to prevent brown spot disease we suggest you apply',            
        ]);
        
        DB::table('plant_dev_regiments')->insert([
            'species' =>'maize',
            'age_limits' =>21,
            'suppliment' =>'Urea',
            'tips' =>'Apply a HandFull Of Urea At The Base Of each Emerging Folliage on',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'beans',
            'age_limits' =>21,
            'suppliment' =>'insecticide',
            'tips' =>'apply insecticede on the emerging dhoot to prevent pests such as army worms on',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'beans',
            'age_limits' =>21,
            'suppliment' =>'insecticide',
            'tips' =>'apply insecticede on the emerging dhoot to prevent pests such as army worms on',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'beans',
            'age_limits' =>49,
            'suppliment' =>'insecticide',
            'tips' =>'apply insecticede on the emerging dhoot to prevent pests such as army worms on',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'beans',
            'age_limits' =>49,
            'suppliment' =>'npk',
            'tips' =>'administer npk on ',
            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'wheat',
            'age_limits' =>160,
            'suppliment' =>'scare-crow',
            'tips' =>'the wheat is almost ready we suggest installing a scare crow or a mechanism that will hell eliminate the birds on',            
        ]);
        DB::table('plant_dev_regiments')->insert([
            'species' =>'wheat',
            'age_limits' =>70,
            'suppliment' =>'weed controll',
            'tips' =>'to prevent broad leaf weeds on ',            
        ]);

        
    }
}

