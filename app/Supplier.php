<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Image;

class Supplier extends Model
{
    public function new_enrolement(array $validated)
    {

        $sup = new Supplier;
        $sup->name = $validated['name'];
        $sup->email= $validated['email'];
        $sup->location= $validated['location'];
        #supus will be zero since he or she has not been vetted and given an account
        $sup->status=0;
        $sup->phone= $validated['phone_number'];
        #supe the one being registerd has never been rated before...
        $sup->ratings= 0;      
        if (array_key_exists('hardware',$validated) && array_key_exists('agrovet',$validated) ) {
            $sup->specialty = 'all';
        } else {
            $sup->specialty = (array_key_exists('hardware',$validated) ? 'hardware' : 'agrovet');
        }        
        $sup->transport =(array_key_exists('transport',$validated) ? 'able' : 'unable') ;
        $sup->ratings = 0;
        $path = $validated['kra']->store('kra','s3');
        $sup->image_url = $path;
        $sup->save();
    }
    public function confirm($id)
    {
        $new_user = $this->find($id);
        $new_user->status= 1;
        $new_account = User::create([
         'name' => $new_user->name,
         'email' => $new_user->email,
         'password' => Hash::make($new_user->id_number),
         'last_login'=> null,
         'location'=>$new_user->location,
         ]);
         $new_user->user_id = $new_account->id;
         $new_user->save();
         return $new_user;
    }
    public function pending_suplier_requests()
    {
        return DB::table('suppliers')
                    ->where('status','=',0)
                    ->get();
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
