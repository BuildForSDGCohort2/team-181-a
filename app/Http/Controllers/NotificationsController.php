<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Isues;
use App\Proffesional;
use App\Supplier;
use App\Order;
use App\Pregnant;
use App\Waiting;
use Illuminate\Support\Arr;

class NotificationsController extends Controller
{
    #this will controll the to do button and liad the data accordinglt
    public function notification_selector(Proffesional $profesionals )    {

        #one should also be anble to view all the goods in transit pending etc
        $pending_profesionals =  $profesionals->pending_requests();

        return view('admin.proff')
                ->with('pending_profesionals', $pending_profesionals);


    }

    public function get_notifications(Isues $issue)
    {
        return $issue->get_unsolved_issues();
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
        // return (($issues));
        return view('pages.issues')->with('issues',$issues);
    }

    public function show_issue(Isues $issue, $id)
    {
        return $issue->get_issue($id);
    }

    public function summon_request(Isues $issue, $id)
    {
        $waiting = new Waiting;

        $waiting = $waiting->waiting($id);

        return $waiting[0];
    }

    public function issue_req($id, $text)
    {
        // return $text;
        // $waiting = Waiting::find($id);

        $waiting = Waiting::find($id);
        $service_arr = explode('-', $waiting->service);

        if (($key = array_search($text, $service_arr)) !== false) {
            unset($service_arr[$key]);
        }
        $waiting->service = collect($service_arr)->implode('-');

        $waiting->save();

        // return $text_str;

        if ($text == 'ai') {
            $waiting->insemination($id);
        } elseif ($text == 'sale') {
            $waiting->cofirm_sale($id);
        } elseif ($text == 'ij') {
            $waiting->sick($id);
        } elseif ($text == 'well') {
            $waiting->well($id);

            return [];
        }


        $waiting = new Waiting;

        $waiting = $waiting->waiting($id);
        // $waiting->transform(function($item) {
        //     $item->service_arr = explode('-', $item->service);
        //     return $item;
        // });
        return $waiting[0];
        // return $waiting;


        // return $id;
        // return $request->all();
    }


}


