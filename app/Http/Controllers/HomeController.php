<?php

namespace App\Http\Controllers;
use App\Isues;
use App\Proffesional;
use App\Supplier;
use App\Order;
use App\User;
use App\Animal;
use App\Storage;
use App\Sales;


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
    public function index(Isues $issue, Proffesional $proffesional,Supplier $supplier,Order $order,User $user, Storage $store,Sales $sales )
    {

        if (auth()->user()->hasRole('admin')) {
            // load all necesarry data
            $proffesionals = $proffesional->pending_requests();
            $suppliers = $supplier->pending_suplier_requests();
            $orders = $order->get_orders();
            $latest_logins =  $user->all()->sortBy('last_login');
            return view('admin.dash')->with('suppliers',$suppliers)
                    ->with('orders',$orders)
                    ->with('latest_logins',$latest_logins)
                    ->with('proffesionals',$proffesionals);

        }elseif (auth()->user()->hasRole('vet')||auth()->user()->hasRole('feo')||auth()->user()->hasRole('supplier')) {
            return view('prof.dash');

        }elseif(auth()->user()->hasRole('farmer')){
            $issues = $issue->get_unsolved_issues();
            return view('dashboard')->with('issues',$issues);

        }else {
            return redirect('on_sale');
        }

    }
}
