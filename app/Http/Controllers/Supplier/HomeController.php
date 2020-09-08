<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;

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

    /**
     * Show the Supplier dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('supplier.home');
    }

}