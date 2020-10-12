<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','location','last_login','location','phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function  get_available($location)
    {
        User::all()->filter(function($user) use ($location,$role) {return $user->hasRole('vet') && $user->location=== $location; });
    }
    //to get the
    public function get_prev_logins()
    {
        return User::orderBy('last_login','desc');

    }
    public function my_profile()
    {   $user = auth()->user();
        if ($user->hasRole('vet') ||$user->hasRole('feo') ) {
            return $user->proffesional;
        } elseif($user->hasRole('farmer')) {
            return $user->farmer;
        }else{
            return ;
        }

    }
    public function profile($user)
    {

        if ($user->hasRole('vet') ||$user->hasRole('feo') ) {
            return $user->proffesional;
        } elseif($user->hasRole('farmer')) {
            return $user->farmer;
        }else{
            return ;
        }
    }

    public static function summon_proffesional($location)
    {
        $wanted_profs = User::role('vet')->where('location',$location)->pluck('id');

        if (count($wanted_profs) == null) {
            $selected_prof = 0;
        }
        elseif (count($wanted_profs) > 1) {
            $selected_prof = array_rand($wanted_profs->toArray());
        } else {
            $selected_prof = $wanted_profs->toArray()[0];
        }

        return $selected_prof;
    }

    public function request_regiment($location)
    {
        $wanted_supplier = User::role('supplier')->where('location',$location)->pluck('id');

        if (count($wanted_supplier) === null) {
            $selected_supplier = 0;
        }
        elseif (count($wanted_profs) > 1) {
            $selected_supplier = array_rand($wanted_supplier->toArray());
        } else {
            $selected_supplier = $wanted_supplier->toArray()[0];
        }

        return $selected_supplier;
    }
    public function get_transporter()
    {
        $wanted_supplier = User::role('supplier')->where('location',auth()->user()->location)->filter(function($user){return $user->profile->transport = 'able';})->pluck('id');

        if (count($wanted_supplier) === null) {
            $selected_supplier = 0;
        }
        elseif (count($wanted_profs) > 1) {
            $selected_supplier = array_rand($wanted_supplier->toArray());
        } else {
            $selected_supplier = $wanted_supplier->toArray()[0];
        }

        return $selected_supplier;
    }


    public function animal(){
        return $this->hasMany('App\Animal');
    }
    public function plantations(){
        return $this->hasMany('App\Plantation');
    }
    public function order()
    {
        return $this->hasMany('App\Order','user_id');
    }
    public function proffesional()
    {
        return $this->hasOne('App\Proffesional');
    }
    public function supplier()
    {
        return $this->hasOne('App\Supplier');
    }
    public function farmer()
    {
        return $this->hasOne('App\Farmer');
    }
    public function stored_products()
    {
        return $this->hasManyThrough('App\Storage','App\Plantation','user_id','plantation_id');
    }
    public function pregnant()
    {
        return $this->hasMany('App\Pregnant');
    }
    public function patients()
    {
        return $this->hasMany('App\Animal_Ailments','vet_id');
    }
    
    public function transporter()
    {
        return $this->hasMany('App\ScheduledHarvest','transporter_id');
    }

}
