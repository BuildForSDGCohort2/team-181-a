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
        $maize_types = ['katumani','40A','70B','A009','30G19','P3812','Twiga 81'];
        $facts = ['species'=>'maize','optimal_conditions'=>'cool and wet','months_to_maturity'=>6,'production_rate'=>30,'shelf_life'=>1040,'storage_meth'=>'Dry the Seed And Put in bags','price_per_bag'=>1800];
        
        $bean_types= ['rosecoco','chik peas','aduki','black eyed peas','soya','marowfat','black turtle'];
        $bean_facts = ['species'=>'beans','optimal_conditions'=>'cool and wet','months_to_maturity'=>3,'production_rate'=>30,'shelf_life'=>1040,'storage_meth'=>'Dry the Seed And Put in bags','price_per_bag'=>2800];
        
        $wheat_types=  ['lemeso','haby','mangudo','amina','durum','sallet','wheat-thinopyrum'];
        $wheat_facts = ['species'=>'wheat','optimal_conditions'=>'cool and dry','months_to_maturity'=>6,'production_rate'=>30,'shelf_life'=>1040,'storage_meth'=>'Dry the Seed And Put in bags','price_per_bag'=>1800];
        
        $rice_types =  ['kienyeji','exotic'];
        $rice_facts = ['species'=>'wheat','optimal_conditions'=>'cool and wet','months_to_maturity'=>6,'production_rate'=>30,'shelf_life'=>1040,'storage_meth'=>'Dry the Seed And Put in bags','price_per_bag'=>4800];
        
        $tea_types=  ['green','purple'];
        $tea_facts = ['species'=>'tea','optimal_conditions'=>'cool and wet','months_to_maturity'=>24,'production_rate'=>300,'shelf_life'=>0,'storage_meth'=>'perishable','price_per_bag'=>300];
    
        $coffee_types= ['arabica','robusta'];
        $coffee_facts = ['species'=>'cofee','optimal_conditions'=>'cool and wet','months_to_maturity'=>24,'production_rate'=>300,'shelf_life'=>0,'storage_meth'=>'perishable','price_per_bag'=>300];
        
        $x = 0;
        while (True) {
            while ($x < count($maize_types)) {
                DB::table('plant_fact_sheets')->insert([
                    'species' =>'maize',
                    'type'=>$maize_types[$x],
                    'optimal_conditions' =>$facts['optimal_conditions'],
                    'months_to_maturity' =>$facts['months_to_maturity'],
                    'production_rate' =>$facts['production_rate'],
                    'shelf_life' =>$facts['shelf_life'],
                    'storage_meth' =>$facts['storage_meth'],
                    'price_per_bag' =>$facts['price_per_bag'],
                ]);
                $x+=1;
            }


            $pointer = 0;
            while ($pointer < count($bean_types) ) {
                DB::table('plant_fact_sheets')->insert([
                    'species' =>'beans',
                    'type'=>$bean_types[$pointer],
                    'optimal_conditions' =>$bean_facts['optimal_conditions'],
                    'months_to_maturity' =>$bean_facts['months_to_maturity'],
                    'production_rate' =>$bean_facts['production_rate'],
                    'shelf_life' =>$bean_facts['shelf_life'],
                    'storage_meth' =>$bean_facts['storage_meth'],
                    'price_per_bag' =>$bean_facts['price_per_bag'],
                ]);
                $pointer += 1;
            }

 
            $pointer = 0;
            while ($pointer < count($wheat_types) ) {
                DB::table('plant_fact_sheets')->insert([
                    'species' =>'wheat',
                    'type'=>$wheat_types[$pointer],
                    'optimal_conditions' =>$wheat_facts['optimal_conditions'],
                    'months_to_maturity' =>$wheat_facts['months_to_maturity'],
                    'production_rate' =>$wheat_facts['production_rate'],
                    'shelf_life' =>$wheat_facts['shelf_life'],
                    'storage_meth' =>$wheat_facts['storage_meth'],
                    'price_per_bag' =>$wheat_facts['price_per_bag'],
                ]);
                $pointer += 1;
            }

   
        
     
            $pointer = 0;
            while ($pointer < count($rice_types) ) {
                DB::table('plant_fact_sheets')->insert([
                    'species' =>'rice',
                    'type'=>$rice_types[$pointer],
                    'optimal_conditions' =>$rice_facts['optimal_conditions'],
                    'months_to_maturity' =>$rice_facts['months_to_maturity'],
                    'production_rate' =>$rice_facts['production_rate'],
                    'shelf_life' =>$rice_facts['shelf_life'],
                    'storage_meth' =>$rice_facts['storage_meth'],
                    'price_per_bag' =>$rice_facts['price_per_bag'],
                ]);
                $pointer += 1;
            }
    
            $pointer = 0;
            while ($pointer < count($tea_types) ) {
                DB::table('plant_fact_sheets')->insert([
                    'species' =>'tea',
                    'type'=>$tea_types[$pointer],
                    'optimal_conditions' =>$tea_facts['optimal_conditions'],
                    'months_to_maturity' =>$tea_facts['months_to_maturity'],
                    'production_rate' =>$tea_facts['production_rate'],
                    'shelf_life' =>$tea_facts['shelf_life'],
                    'storage_meth' =>$tea_facts['storage_meth'],
                    'price_per_bag' =>$tea_facts['price_per_bag'],
                ]);
                $pointer += 1;
            }


            $pointer = 0;
            while ($pointer < count($coffee_types) ) {
                DB::table('plant_fact_sheets')->insert([
                    'species' =>'coffee',
                    'type'=>$coffee_types[$pointer],
                    'optimal_conditions' =>$coffee_facts['optimal_conditions'],
                    'months_to_maturity' =>$coffee_facts['months_to_maturity'],
                    'production_rate' =>$coffee_facts['production_rate'],
                    'shelf_life' =>$coffee_facts['shelf_life'],
                    'storage_meth' =>$coffee_facts['storage_meth'],
                    'price_per_bag' =>$coffee_facts['price_per_bag'],
                ]);
                $pointer += 1;
            };
    break;
    };
}
}
