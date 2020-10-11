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

    //    return gettype($request->orders);
        #this fuction will fetch all the orders    
        $order->dispatch_orders($request->orders);
        return redirect('dispatch')->with('succes','Dispatch successfully All the Goods Are in Transit');
      

    }
    public function order_delivery($request, Order $order, Isues $issue)
    {
        $order->deliver($request->orders);
        $issue->delivery_alert($order);
        return redirect('dispatch')->with('succes','Dispatch successfully All the Goods Are in Transit');
    }

    public function dispatch_orders(Order $order)
    {
        #here we wont use the all clause we will take up undelivered ones only

        $grouped_orders = $order->where('order_status',0)->get()->groupBy(function ($order) {
            return $order->user->location;
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

    public function recievers_dash(Order $order)
    {
       $transit_orders= $order->get_transit_orders();
    //    return $transit_orders;
        return view('recievers_dash')->with('transit_orders',$transit_orders);
    }
    public function ready_for_pickup(Order $order)
    {
       $ready_orders= $order->get_deliverd_orders();
    //    return $transit_orders;
        return view('ready')->with('ready_orders',$ready_orders);
    }
}
