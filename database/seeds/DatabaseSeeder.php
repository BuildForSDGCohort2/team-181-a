<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        $this->call([RolesAndPermissionsSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([AnimalFactsheet_Seeder::class]);
        $this->call([PlantFactsheet_Seeder::class]);
        $this->call([PlantDevRegSeeder::class]);
        $this->call([AgeRegimentSeeder::class]);


    }
}
