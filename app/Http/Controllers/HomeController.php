<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $permissions = [];
        foreach (Permission::all() as $permission) {
            if (Auth::user()->can($permission->name)) {
                $permissions[$permission->name] = true;
            } else {
                $permissions[$permission->name] = false;
            }
        }
        // $country = Country::find($user->country_id);
        // // dd($country);
        // $user->country_name = $country->country_name;
        // $users->transform(function ($user, $key) {
        //     $country = Country::find($user->country_id);
        //     $user->country_name = $country->name;
        // 	return $user;
        // });
        // dd(json_decode(json_encode((Auth::user()), false)));
        $user = Auth::user();
        // $user = $user->append('is_client')->toArray();
        // $user = $user->setAppends(['is_client', 'is_admin'])->toArray();
        // $auth_user = array_prepend($user, $permissions, 'can');
        // $auth_user = Arr::prepend($user->toArray(), $permissions, 'can');

        $auth_user = Auth::user();
        return view('welcome', compact('auth_user'));
    }
}
