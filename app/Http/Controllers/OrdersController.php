<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Order;
use App\Isues;
use App\Users;

class OrdersController extends Controller
{
    #view all thats ready for order
    public function for_sale(Sales $sale,Order $order)
    {
        $prods_on_sale = $sale->all()->filter(function($product){return $product->status !== 1;});
        return view('products_dash')->with('prods_on_sale',$prods_on_sale);
    }
    
    
    #view Prod befor buying
    public function view_prod(Request $request, Sales $sale )
    {
        $prod = $sale->get_product($request);
        // return $prod;
        return view('orders.buy_item')->with('prod',$prod);
    }
    #place order
    
    
    
    public function place_order(Request $request,Sales $sale,Order $order,Isues $issue)
    {   
        // return $request;
        $product_for_sale  = $sale->process_order($request);
        // return $product_for_sale['product'];
        $order_info = $order->create_order($product_for_sale);
        
        $issue->order_alert($order_info);
        // return $order_info;
        return redirect('on_sale');
    }
    #revoke Order 

    
    
    #view personal orders
    public function my_orders(Order $order)
    {
        
        $myorders = $order->get_orders();
        $sellers = [];
        if (auth()->user()->hasRole('admin')) {
            foreach ($myorders as $orders) {
                
            }
        }
        return view('orders.orders')->with('myorders',$myorders)->with('use');
    }
    
    #order pickup by drivers
    public function order_pick_up()
    {
        #change the order statust to in  transit.. only the admin and sellers do see this the customer only sees i progress etc...
    }

    #delivered Close the deal
    public function close_order(Request $request,Order $order)
    {
        $order->order_succesfull($request);
        return redirect('orders');
    }
    
    #view professionals
    public function available_proffesionals(User $user)
    {
        $professionals = $user->proffesionals();
        return view('profesionals')->with('proffessionals',$proffessionals);
    }
    public function available_suppliers(User $user)
    {
        $suppliers = $user->suppliers();
        return view('suppliers')->with('suppliers'.$suppliers);
    }
}
