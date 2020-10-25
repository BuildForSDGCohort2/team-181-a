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
            'category' =>'vaccine',
            'species' =>'all',
            'age_limits' =>0,
            'suppliment' =>'infant vaccinations',
            'tips' =>'invite the vet over to make some crucial vaccinations that if go unadministered could lead to death of the infant',
            
        ]);

        DB::table('age_regiments')->insert([
            'category' =>'tag',
            'species' =>'cow',
            'age_limits' =>7,
            'suppliment' =>'tagging for easier identification',
            'tips' =>'tag the animal, this will help in easy identification of the animal',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'tag',
            'species' =>'goat',
            'age_limits' =>7,
            'suppliment' =>'tagging for easier identification',
            'tips' =>'tag the animal, this will help in easy identification of the animal',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'tag',
            'species' =>'sheep',
            'age_limits' =>7,
            'suppliment' =>'tagging for easier identification',
            'tips' =>'tag the animal, this will help in easy identification of the animal',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'castration',
            'species' =>'cow',
            'age_limits' =>7,
            'suppliment' =>'castration',
            'tips' =>'if the animal is intended for beef produce , its adviscible to have the animal castrated for better results',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'castration',
            'species' =>'goat',
            'age_limits' =>7,
            'suppliment' =>'castration',
            'tips' =>'if the animal is intended for beef produce , its adviscible to have the animal castrated for better results',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'castration',
            'species' =>'sheep',
            'age_limits' =>7,
            'suppliment' =>'castration',
            'tips' =>'if the animal is intended for beef produce , its adviscible to have the animal castrated for better results',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'vaccination',
            'species' =>'all',
            'age_limits' =>150,
            'suppliment' =>'five months old vaccinations',
            'tips' =>'summon the vet do that he can adminster the much needed and important 5 minths vaccinations',
            
        ]);;
        DB::table('age_regiments')->insert([
            'category' =>'weaning',
            'species' =>'cow',
            'age_limits' =>150,
            'suppliment' =>'weanimg',
            'tips' =>'its advisable to start weaning the animal at this jumcture',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'weaning',
            'species' =>'goat',
            'age_limits' =>60,
            'suppliment' =>'weanimg',
            'tips' =>'its advisable to start weaning the animal at this jumcture',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'weaning',
            'species' =>'sheep',
            'age_limits' =>60,
            'suppliment' =>'weanimg',
            'tips' =>'its advisable to start weaning the animal at this jumcture',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'feeds',
            'species' =>'chicken',
            'age_limits' =>0,
            'suppliment' =>'chick mash',
            'tips' =>'feed the chiks with chick mash for the next 8 weeks',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'feeds',
            'species' =>'turkey',
            'age_limits' =>0,
            'suppliment' =>'chick mash',
            'tips' =>'feed the chiks with chick mash for the next 8 weeks',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'feeds',
            'species' =>'duck',
            'age_limits' =>0,
            'suppliment' =>'chick mash',
            'tips' =>'feed the chiks with chick mash for the next 8 weeks',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'feeds',
            'species' =>'chicken',
            'age_limits' =>63,
            'suppliment' =>'growers mash',
            'tips' =>'promote the little one to a better diet of growers mash, this will help in making their bodies stronger',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'feeds',
            'species' =>'turkey',
            'age_limits' =>63,
            'suppliment' =>'growers mash',
            'tips' =>'promote the little one to a better diet of growers mash, this will help in making their bodies stronger',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'feeds',
            'species' =>'duck',
            'age_limits' =>63,
            'suppliment' =>'growers mash',
            'tips' =>'promote the little one to a better diet of growers mash, this will help in making their bodies stronger',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'feeds',
            'species' =>'chicken',
            'age_limits' =>126,
            'suppliment' =>'layers or broiler mash',
            'tips' =>'fed them the final mash in the line , this will hel make them stronger and yield better',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'feeds',
            'species' =>'turkey',
            'age_limits' =>126,
            'suppliment' =>'layers or broiler mash',
            'tips' =>'fed them the final mash in the line , this will hel make them stronger and yield better',
            
        ]);
        DB::table('age_regiments')->insert([
            'category' =>'feeds',
            'species' =>'duck',
            'age_limits' =>126,
            'suppliment' =>'layers or broiler mash',
            'tips' =>'fed them the final mash in the line , this will hel make them stronger and yield better',            
        ]);
         



        
    }
}
