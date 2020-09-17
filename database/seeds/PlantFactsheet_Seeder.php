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
        ]);
    }
}
