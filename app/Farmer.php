<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Isues;

class Farmer extends Model
{
    // $tgis table will be automatically fed byt the create user method.. if the user selected the role of a farmer
    protected $guarded=[];

    public function new_enrolement(array $validated  )
    {
        #first record the user infomation
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'last_login'=> null,
            'location'=>$validated['location']
        ]);
        User::latest()->first()->assignRole('farmer');
        #now the farmer's information
        $new_farmer = new Farmer;
        #we must convert the calibration to acres
        if ($validated['callibration'] == 'meters') {
            $size = $validated['size'] / 4047;
        } elseif ($validated['callibration'] == 'hactares') {
            $size = $validated['size'] * 2.471 ;
        } else {
            $size = $validated['size'];
        }
        
        Farmer::create([
            'farm_size'=> $size,
            'location'=>$validated['location'],
            'phone_number'=>$validated['phone_number'],
            'user_id'=>User::latest()->first()->id,
            'email'=>$validated['email'],
            ]);

        #now to remind the farmer To fill in the Animals | crops | Poultry accordigly
        $checks = array_keys($validated['fields']);
        foreach ($checks as $check) {
            if ($check=='animal') {
                $identifier='ANML-01';
                $reason = 'Please Register Your Animals';
            } elseif ($check=='crops') {
                $identifier='PLT-01';
                $reason = 'Please Indicate the Size of Land You have Under Crop Farming.';
            }else {
                $identifier='POLTR-01';
                $reason = 'Please Register Your Poultry Broods';
            }
            

            // move to a new model and will be called after successful email verification
            Isues::create([
                'reason'=>$reason,
                'information'=>'The Information To submitt will be used to aptly Advice You',
                'user_id'=> User::latest()->first()->id,
                'identifier'=>$identifier,
                'status'=>0,
            ]);
        }
        
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
