<?php

use Illuminate\Database\Seeder;

class AnimalFactsheet_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('animal_fact_sheets')->insert([
            'species' =>'unknown',
            'prime_age' =>0,
            'reproductive_age' =>0,
            'maximum_prod_rate' =>0,
            'maximum_weight' =>0,
            'maximum_height' =>0,
            'weight_at_birth' =>0,
            'breed' =>'unknown',
        ]);
        DB::table('animal_fact_sheets')->insert([
            'species' =>'cow',
            'prime_age' =>0,
            'reproductive_age' =>0,
            'maximum_prod_rate' =>0,
            'maximum_weight' =>379,
            'maximum_height' =>0,
            'weight_at_birth' =>30,
            'breed' =>'kienyeji',
        ]);
        DB::table('animal_fact_sheets')->insert([
            'species' =>'sheep or goat',
            'prime_age' =>0,
            'reproductive_age' =>0,
            'maximum_prod_rate' =>0,
            'maximum_weight' =>70,
            'maximum_height' =>0,
            'weight_at_birth' =>9,
            'breed' =>'kienyeji',
        ]);

        DB::table('animal_fact_sheets')->insert([
            'species' =>'poultry',
            'prime_age' =>0,
            'reproductive_age' =>2,
            'maximum_prod_rate' =>1,
            'maximum_weight' =>6,
            'maximum_height' =>1,
            'weight_at_birth' =>0,
            'breed' =>'kienyeji',
        ]);
    }
}
