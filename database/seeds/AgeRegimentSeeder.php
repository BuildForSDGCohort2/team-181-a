<?php

use Illuminate\Database\Seeder;

class AgeRegimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('age_regiments')->insert([
            'category' =>'unknown',
            'breed_id' =>0,
            'age_limits' =>0,
            'suppliment' =>'unknown',
            'tips' =>0,
            
        ]);

        DB::table('age_regiments')->insert([
            'category' =>'vaccine',
            'breed_id' =>2,
            'age_limits' =>0,
            'suppliment' =>'Vaccine',
            'tips' =>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Voluptatem nemo consequuntur nesciunt, aspernatur iure quod beatae
                    tenetur quae autem illo ullam at dolores, esse tempore ducimus
                    placeat vero, optio asperiores.',
            
        ]);

        DB::table('age_regiments')->insert([
            'category' =>'booster',
            'breed_id' =>2,
            'age_limits' =>180,
            'suppliment' =>'Immune Boost',
            'tips' =>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Voluptatem nemo consequuntur nesciunt, aspernatur iure quod beatae
                    tenetur quae autem illo ullam at dolores, esse tempore ducimus
                    placeat vero, optio asperiores.',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'reproboost',
            'breed_id' =>2,
            'age_limits' =>0,
            'suppliment' =>'R',
            'tips' =>'Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
                    Voluptatem nemo consequuntur nesciunt, aspernatur iure quod beatae
                    tenetur quae autem illo ullam at dolores, esse tempore ducimus
                    placeat vero, optio asperiores.',
            
        ]);


        
    }
}
