<?php
use App\User;
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use  App\Mail\AcceptanceMail;
use  App\Mail\RejectMail;
use Mail;

use DB;
use App\Image;


class Proffesional extends Model
{
    public  function new_enrolement(array $validated)
    {


        $prof = new Proffesional;
        $prof->id_number = $validated['id_number'];
        $prof->name = $validated['name'];
        $prof->email= $validated['email'];
        $prof->location= $validated['location'];
        #status will be zero since he or she has not been vetted and given an account
        $prof->status=0;
        $prof->phone= $validated['phone_number'];
        #since the one being registerd has never been rated before...
        $prof->ratings= 0;
        $prof->specialty = $validated['specialty'];
        $prof->exp=$validated['exp'];
        $path = $validated['file']->store('cvs' , 's3');
        $prof->image_url = $path;
        $prof->save();
        echo($path);
    }

   public function confirm($id)
   {
       $new_user = $this->find($id);
       $new_user->status= 1;
       $new_account = new User;
         $new_account->name = $new_user->name;
         $new_account->email = $new_user->email;
         $new_account->password = Hash::make($new_user->id_number);
         $new_account->last_login= null;
         $new_account->location = $new_user->location;
         $new_account->phone_number=$new_user->phone;
         $new_account->save();

         $professional = Proffesional::find($id);
         $professional->status = 1;
         $professional->save();


         $new_account->save();

        $new_account->assignRole($new_user->specialty);
        $new_user->user_id = $new_account->id;
        $new_user->save();
        try{
        Mail::to($new_user->email)->send(new AcceptanceMail($new_user));
        }catch(\Throwable $error){
            #do nothing
        }


        return $new_user;
   }
   public function reject($id)
   {
       $user = $this->find($id);
       try{
        Mail::to($user->email)->send(new RejectMail($user));
       }catch(\Throwable $error){
            // throw $th;
       }
        $user->delete();
   }


    public function pending_requests()
    {
        return DB::table('proffesionals')
                    ->where('status','=',0)
                    ->get();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
