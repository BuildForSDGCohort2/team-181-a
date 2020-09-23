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
        'name', 'email', 'password','location','last_login','location'
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

    //to get the 
    public function get_prev_logins()
    {
        return User::orderBy('last_login','desc');

    }

    public function animal(){
        return $this->hasMany('App\Animal');
    }
    public function plantation(){
        return $this->hasMany('App\Plantation');
    }
    public function order()
    {
        return $this->hasMany('App\Order');
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
}
