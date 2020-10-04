<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Isues;
use App\Proffesional;
use App\Supplier;
use App\Order;


class NotificationsController extends Controller
{
    #this will controll the to do button and liad the data accordinglt
    public function notification_selector(Proffesional $profesionals )    {

        #one should also be anble to view all the goods in transit pending etc
        $pending_profesionals =  $profesionals->pending_requests();

        return view('admin.proff')
                ->with('pending_profesionals', $pending_profesionals);


    }
    public function get_suppliers(Supplier $suppliers)
    {
        $pending_suppliers = $suppliers->pending_suplier_requests();
        return  view('admin.supp')->with('pending_suppliers',$pending_suppliers);

    }
    public function get_orders(Order $order)
    {
        $orders = $order->get_orders();
        return view('orders.orders')->with('orders',$orders);
    }
    public function get_issues(Isues $issue )
    {
        $issues  = $issue->get_unsolved_issues();
        // return $issues;
        return view('pages.issues')->with('issues',$issues);
    }
}


