<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    public function new_enrolement($re)
    {
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'last_login'=> null,
            'location'=>$validated['location']
        ]);
        $user->assignRole('customer');

    }
}
