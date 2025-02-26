<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // admin
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@farmers.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'last_login'=>null,
            'location'=>'nairobi',
            'phone_number'=>'+254768187628',
        ]);
        //farmer
        DB::table('users')->insert([
            'name' => 'Njoroge',
            'email' => 'njoroge@farmers.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'last_login'=>null,
            'location'=>'nakuru',
            'phone_number'=>'+254768187628',


        ]);
        // vet
        DB::table('users')->insert([
            'name' => 'Vet',
            'email' => 'vet@farmers.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'last_login'=>null,
            'location'=>'nakuru',
            'phone_number'=>'+254768187628',


        ]);
        //feo
        DB::table('users')->insert([
            'name' => 'Officer',
            'email' => 'officer@farmers.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'last_login'=>null,
            'location'=>'nakuru',
            'phone_number'=>'+254768187628',


        ]);
        //supplier
        DB::table('users')->insert([
            'name' => 'Supplier',
            'email' => 'supplier@farmers.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'last_login'=>null,
            'location'=>'nakuru',
            'phone_number'=>'+254768187628',

        ]);
        //reciever
        DB::table('users')->insert([
            'name' => 'Reciever',
            'email' => 'reciever@farmers.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'last_login'=>null,
            'location'=>'nakuru',
            'phone_number'=>'+254768187628',

        ]);
        //customer
        DB::table('users')->insert([
            'name' => 'Customer',
            'email' => 'customer@farmers.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now(),
            'last_login'=>null,
            'location'=>'nakuru',
            'phone_number'=>'+254768187628',

        ]);
        //admin
        DB::table('model_has_roles')->insert([
            'role_id'=>1,
            'model_type'=>'App\User',
            'model_id'=>1,
        ]);
        //farmer
        DB::table('model_has_roles')->insert([
            'role_id'=>2,
            'model_type'=>'App\User',
            'model_id'=>2,
        ]);
        // vet
        DB::table('model_has_roles')->insert([
            'role_id'=>3,
            'model_type'=>'App\User',
            'model_id'=>3,
        ]);
        //feo
        DB::table('model_has_roles')->insert([
            'role_id'=>4,
            'model_type'=>'App\User',
            'model_id'=>4,
        ]);
        //Supplier
        DB::table('model_has_roles')->insert([
            'role_id'=>5,
            'model_type'=>'App\User',
            'model_id'=>5,
        ]);
        //Customer
        DB::table('model_has_roles')->insert([
            'role_id'=>6,
            'model_type'=>'App\User',
            'model_id'=>7,
        ]);
        DB::table('model_has_roles')->insert([
            'role_id'=>7,
            'model_type'=>'App\User',
            'model_id'=>6,
        ]);
    }
}
