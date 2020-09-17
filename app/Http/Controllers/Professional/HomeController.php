<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;

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

    /**
     * Show the Professional dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('professional.home');
    }

}