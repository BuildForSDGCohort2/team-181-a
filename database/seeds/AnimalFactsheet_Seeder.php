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
        $cattle_breeds = ['kienyeji','friesian','ayshire','guernsey','jersey','boran','sahiwal'];
        $facts = ['species'=>'cow','prime_age'=>510,'reproductive_age'=>630,'maximum_prod_rate'=>30,'maximum_weight'=>100,'maximum_height'=>6,'price'=>10000 ,'weight_at_birth'=>39000,'gestation_period'=>292];
        
        $goat_breeds= ['kienyeji','saanen','nigerian dwarf','kalahari red','jamnapari','west african dwarf','boer'];
        $goat_facts=['species'=>'goat','prime_age'=>365,'reproductive_age'=>180,'maximum_prod_rate'=>12,'maximum_weight'=>50,'maximum_height'=>4,'price'=>8000 ,'weight_at_birth'=>3500,'gestation_period'=>150];
        
        $sheep_breeds=  ['kienyeji','doper','merino','dohne merino','afrino','boran','pedi'];
        $sheep_facts=['species'=>'sheep','prime_age'=>310,'reproductive_age'=>180,'maximum_prod_rate'=>10,'maximum_weight'=>60,'maximum_height'=>4,'price'=>6000 ,'weight_at_birth'=>3500,'gestation_period'=>152];
        
        $duck_breeds =  ['kienyeji','exotic'];
        $duck_facts=['species'=>'duck','prime_age'=>112,'reproductive_age'=>100,'maximum_prod_rate'=>1,'maximum_weight'=>12,'maximum_height'=>3,'price'=>3000 ,'weight_at_birth'=>40,'gestation_period'=>30];
        
        $chicken_breeds=  ['kienyeji','exotic'];
        $chicken_facts=['species'=>'chicken','prime_age'=>112,'reproductive_age'=>100,'maximum_prod_rate'=>1,'maximum_weight'=>6,'maximum_height'=>3,'price'=>300 ,'weight_at_birth'=>120,'gestation_period'=>21];
    
        $turkey_breeds= ['kienyeji','exotic'];
        $turkey_facts=['species'=>'turkey','prime_age'=>112,'reproductive_age'=>100,'maximum_prod_rate'=>1,'maximum_weight'=>10,'maximum_height'=>3,'price'=>3000 ,'weight_at_birth'=>120,'gestation_period'=>28];
        
        $x = 0;
        while (True) {
            while ($x < 7) {
                DB::table('animal_fact_sheets')->insert([
                    'species' =>'cow',
                    'prime_age' =>$facts['prime_age'],
                    'reproductive_age' =>$facts['reproductive_age'],
                    'maximum_prod_rate' =>$facts['maximum_prod_rate'],
                    'maximum_weight' =>$facts['maximum_weight'],
                    'maximum_height' =>$facts['maximum_height'],
                    'weight_at_birth' =>$facts['weight_at_birth'],
                    'breed' =>$cattle_breeds[$x],#indeginous 
                    'price'=>$facts['price'],
                    'gestation_period'=>$facts['gestation_period'],
                ]);
                $x+=1;
            }


            $pointer = 0;
            while ($pointer < 7) {
                DB::table('animal_fact_sheets')->insert([
                    'species' =>'goat',
                    'prime_age' =>$goat_facts['prime_age'],
                    'reproductive_age' =>$goat_facts['reproductive_age'],
                    'maximum_prod_rate' =>$goat_facts['maximum_prod_rate'],
                    'maximum_weight' =>$goat_facts['maximum_weight'],
                    'maximum_height' =>$goat_facts['maximum_height'],
                    'weight_at_birth' =>$goat_facts['weight_at_birth'],
                    'breed' =>$goat_breeds[$pointer],#indeginous 
                    'price'=>$goat_facts['price'],
                    'gestation_period'=>$goat_facts['gestation_period'],
                    
                ]);
                $pointer += 1;
            }

 

            while ($pointer < 7) {
                DB::table('animal_fact_sheets')->insert([
                    'species' =>'sheep',
                    'prime_age' =>$sheep_facts['prime_age'],
                    'reproductive_age' =>$sheep_facts['reproductive_age'],
                    'maximum_prod_rate' =>$sheep_facts['maximum_prod_rate'],
                    'maximum_weight' =>$sheep_facts['maximum_weight'],
                    'maximum_height' =>$sheep_facts['maximum_height'],
                    'weight_at_birth' =>$sheep_facts['weight_at_birth'],
                    'breed' =>$sheep_breeds[$pointer],#indeginous 
                    'price'=>$sheep_facts['price'],
                    'gestation_period'=>$sheep_facts['gestation_period'],
                    
                ]);
                $pointer +=1;
            }

   
        
     
            $pointer = 0 ;
            while ($pointer < 2) {
                DB::table('animal_fact_sheets')->insert([
                    'species' =>'chicken',
                    'prime_age' =>$chicken_facts['prime_age'],
                    'reproductive_age' =>$chicken_facts['reproductive_age'],
                    'maximum_prod_rate' =>$chicken_facts['maximum_prod_rate'],
                    'maximum_weight' =>$chicken_facts['maximum_weight'],
                    'maximum_height' =>$chicken_facts['maximum_height'],
                    'weight_at_birth' =>$chicken_facts['weight_at_birth'],
                    'breed' =>$chicken_breeds[$pointer],#indeginous 
                    'price'=>$chicken_facts['price'],
                    'gestation_period'=>$chicken_facts['gestation_period'],
                    
                ]);
                $pointer +=1;
            
                }
    
            $pointer = 0 ;
            while ($pointer < 2) {
                DB::table('animal_fact_sheets')->insert([
                    'species' =>'turkey',
                    'prime_age' =>$turkey_facts['prime_age'],
                    'reproductive_age' =>$turkey_facts['reproductive_age'],
                    'maximum_prod_rate' =>$turkey_facts['maximum_prod_rate'],
                    'maximum_weight' =>$turkey_facts['maximum_weight'],
                    'maximum_height' =>$turkey_facts['maximum_height'],
                    'weight_at_birth' =>$turkey_facts['weight_at_birth'],
                    'breed' =>$turkey_breeds[$pointer],#indeginous 
                    'price'=>$turkey_facts['price'],
                    'gestation_period'=>$turkey_facts['gestation_period'],
                    
                ]);
                $pointer +=1;
            }


            $pointer = 0 ;
            while ($pointer < 2) {
                DB::table('animal_fact_sheets')->insert([
                    'species' =>'duck',
                    'prime_age' =>$duck_facts['prime_age'],
                    'reproductive_age' =>$duck_facts['reproductive_age'],
                    'maximum_prod_rate' =>$duck_facts['maximum_prod_rate'],
                    'maximum_weight' =>$duck_facts['maximum_weight'],
                    'maximum_height' =>$duck_facts['maximum_height'],
                    'weight_at_birth' =>$duck_facts['weight_at_birth'],
                    'breed' =>$turkey_breeds[$pointer],#indeginous 
                    'price'=>$duck_facts['price'],
                    'gestation_period'=>$duck_facts['gestation_period'],
                    
                ]);
                $pointer +=1;
            } 
    break;
    }
    }
}
