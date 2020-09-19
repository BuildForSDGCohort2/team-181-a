<?php

use Illuminate\Database\Seeder;

class PlantFactsheet_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plant_fact_sheets')->insert([
            'type' =>'unknown',
            'species' => 'user_defined',
            'optimal_conditions' => 'unknown',
            'months_to_maturity' =>0,
            'storage_meth' => 'unknown',
            'shelf_life' => 0,
            'production_rate'=>30,
        ]);
        DB::table('plant_fact_sheets')->insert([
            'type' =>'30A',
            'species' => 'maize',
            'optimal_conditions' => 'warm & wet',
            'months_to_maturity' =>6,
            'storage_meth' => 'Dry And Store in bags',
            'shelf_life' => 00,
            'production_rate'=>30,
        ]);
        DB::table('plant_fact_sheets')->insert([
            'type' =>'rose coco',
            'species' => 'beans',
            'optimal_conditions' => 'warm and wet',
            'months_to_maturity' =>0,
            'storage_meth' => 'Dry and Put in bags',
            'shelf_life' => 0,
            'production_rate'=>30,
        ]);
        DB::table('plant_fact_sheets')->insert([
            'type' =>'purple tea',
            'species' => 'tea',
            'optimal_conditions' => 'cool and wet',
            'months_to_maturity' =>0,
            'storage_meth' => 'Perishable!!',
            'shelf_life' => 0,
            'production_rate'=>30,
        ]);
        DB::table('plant_fact_sheets')->insert([
            'type' =>'arabica',
            'species' => 'coffee',
            'optimal_conditions' => 'cool and wet',
            'months_to_maturity' =>0,
            'storage_meth' => 'Perishable!!',
            'shelf_life' => 0,
            'production_rate'=>30,
        ]);
    }
}
