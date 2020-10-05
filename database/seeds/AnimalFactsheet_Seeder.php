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
            'price'=>1000,
            'gestation_period'=>6,
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
            'price'=>20000,
            'gestation_period'=>292,

        ]);
        DB::table('animal_fact_sheets')->insert([
            'species' =>'sheep',
            'prime_age' =>0,
            'reproductive_age' =>0,
            'maximum_prod_rate' =>0,
            'maximum_weight' =>70,
            'maximum_height' =>0,
            'weight_at_birth' =>9,
            'breed' =>'kienyeji',
            'price'=>7000,
            'gestation_period'=>145,

        ]);
        DB::table('animal_fact_sheets')->insert([
            'species' =>'goat',
            'prime_age' =>0,
            'reproductive_age' =>0,
            'maximum_prod_rate' =>0,
            'maximum_weight' =>70,
            'maximum_height' =>0,
            'weight_at_birth' =>9,
            'breed' =>'kienyeji',
            'price'=>7000,
            'gestation_period'=>145,

        ]);

        DB::table('animal_fact_sheets')->insert([
            'species' =>'chicken',
            'prime_age' =>0,
            'reproductive_age' =>2,
            'maximum_prod_rate' =>1,
            'maximum_weight' =>6,
            'maximum_height' =>1,
            'weight_at_birth' =>0,
            'breed' =>'kienyeji',
            'price'=>1000,

        ]);
        DB::table('animal_fact_sheets')->insert([
            'species' =>'turkey',
            'prime_age' =>0,
            'reproductive_age' =>2,
            'maximum_prod_rate' =>1,
            'maximum_weight' =>6,
            'maximum_height' =>1,
            'weight_at_birth' =>0,
            'breed' =>'kienyeji',
            'price'=>1000,

        ]);
        DB::table('animal_fact_sheets')->insert([
            'species' =>'duck',
            'prime_age' =>0,
            'reproductive_age' =>2,
            'maximum_prod_rate' =>1,
            'maximum_weight' =>6,
            'maximum_height' =>1,
            'weight_at_birth' =>0,
            'breed' =>'kienyeji',
            'price'=>1000,

        ]);
    }
}
