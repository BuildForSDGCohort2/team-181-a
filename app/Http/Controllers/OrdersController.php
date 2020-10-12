<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use App\Sales;
use App\Order;
use App\Isues;
use App\User;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    #view all thats ready for order
    public function for_sale(Sales $sale, Order $order)
    {
        $prods_on_sale = $sale->all()->filter(function ($product) {
            return $product->status !== 1;
        });
        return view('products_dash')->with('prods_on_sale', $prods_on_sale);
    }


    #view Prod befor buying
    public function view_prod(Request $request, Sales $sale)
    {
        $prod = $sale->get_product($request);
        // return $prod;
        return view('orders.buy_item')->with('prod', $prod);
    }
    #place order


    public function place_order(Request $request, Sales $sale, Order $order, Isues $issue)
    {
        // return $request->all();

        $cart = Cart::where('user_id', Auth::id())->get();

        foreach ($cart as $item) {
            $product_for_sale  = $sale->process_order($request, $item);
            // return $product_for_sale['product'];
            $order_info = $order->create_order($product_for_sale);
            $issue->order_alert($order_info);
        }

        foreach ($cart as $value) {
            $value->delete();
        }

        // return $order_info;
        return redirect('on_sale');
    }
    #revoke Order



    #view personal orders
    public function my_orders(Order $order)
    {

        $myorders = $order->get_orders();
        return view('orders.orders')->with('myorders', $myorders);
    }

    #order pickup by drivers
    public function order_pick_up(Request $request, Order $order, Isues $issue)
    {

        // return $request;
        #change the order statust to in  transit.. only the admin and sellers do see this the customer only sees i progress etc...
        foreach ($request as $location) {
            foreach ($location as $loc_order) {
                $order->transit($loc_order->id);
            }
        }
        #now alert the customer
        foreach ($request as $location) {
            foreach ($location as $loc_order) {
                $issue->in_transit_alert($loc_order->id);
            }
        }
    }
    public function order_delivery($request, Order $order, Isues $issue)
    {
        return $request;
        foreach ($request as $location) {
            foreach ($location as $loc_order) {
                $order->deliver($loc_order->id);
            }
        }
        #now alert the customer
        foreach ($request as $location) {
            foreach ($location as $loc_order) {
                $issue->delivery_alert($loc_order->id);
            }
        }
    }

    public function dispatch_orders(Order $order)
    {
        #here we wont use the all clause we will take up undelivered ones only

        $grouped_orders = $order->all()->groupBy(function ($order) {
            return $order->get_seller($order->seller_id)->location;
        });
        // return $grouped_orders;
        return view('orders.dispatch')->with('grouped_orders', $grouped_orders);
    }

    public function pick_order(Request $request, Order $order)
    {
        $order->transit($request->id);
        return redirect('orders');
    }
    #delivered Close the deal
    public function close_order(Request $request, Order $order, Isues $issue)
    {
        $completed_order =  $order->order_succesfull($request);
        $issue->delivery_alert($completed_order);
        return redirect('orders');
    }

    #view professionals
    public function available_proffesionals(User $user)
    {
        $professionals = $user->proffesionals();
        return view('profesionals')->with('proffessionals', $proffessionals);
    }
    public function available_suppliers(User $user)
    {
        $suppliers = $user->suppliers();
        return view('suppliers')->with('suppliers' . $suppliers);
    }
}
