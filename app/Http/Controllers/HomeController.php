<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            return view('admin.dash');
        }elseif (auth()->user()->hasRole('vet')||auth()->user()->hasRole('feo')) {
            return view('prof.dash');
        }else {
            return view('dashboard');
        }   
        
    }
}
