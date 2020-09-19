<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;
use App\User;

class HomeController extends Controller
{

    protected $redirectTo = '/professional/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('professional.auth:professional');
    }



    public function logged_user()
    {
        $user = new User();
        return $user->logged_user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $permissions = [];
        // foreach (Permission::all() as $permission) {
        //     if (Auth::user()->can($permission->name)) {
        //         $permissions[$permission->name] = true;
        //     } else {
        //         $permissions[$permission->name] = false;
        //     }
        // }
        $auth_user = $this->logged_user();
        return view('home', compact('auth_user'));
    }


}
