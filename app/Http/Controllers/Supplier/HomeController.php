<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Permission;

class HomeController extends Controller
{

    protected $redirectTo = '/supplier/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('supplier.auth:supplier');
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
