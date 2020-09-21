<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function notification_selector()
    {
        if (auth()->user()->hasRole('admin')) {
            $pending_suppliers = \App\Supplier::where('status','=',0);
            $pending_profesionals =  \App\Proffessional::where('status','=',0);
        } elseif (auth()->user()->hasRole('farmer')) {
            $issues = \App\Isues::where(['status' ,'=',0],['user_id','=',auth()->user()->id]);
        } elseif (auth()->user()->hasRole('customer')) {
            $orders = \App\Order::where(['order_status','=',0],['customer_id','=',auth()->user()->id]);
        }         
        elseif (condition) {
            # code...
        }
        
    }
}
