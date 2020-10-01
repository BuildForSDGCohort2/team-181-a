<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Order;

class OrdersController extends Controller
{
    #view all thats ready for order
    public function for_sale(Sales $sale,Order $order)
    {
        $prods_on_sale = $sale->all();
        return view('products_dash')->with('prods_on_sale',$prods_on_sale);
    }
    #view Prod befor buying
    public function view_prod(Request $request, Sales $sale )
    {
        $prod = $sale->get_product($request);
        return $prod;
        return view('view_product')->with('prod',$prod);
    }
    #place order
    public function place_order(Sales $sale,Order $order,OrderStore $request)
    {
        $sale->place_order($request);
        return view('products_dash')->with('message','Order Placed');
    }
    #revoke Order
    public function cancel_order(Request $request ,Sales $sale )
    {
        $order->cancel_order($request);
        return view('products_dash')->with('message','Order Canceled');
    }
    #view personal orders
    public function my_orders(Order $order)
    {
        $myorders = $order->personal_orders();
        return redirect('orders')->with('myorders',$myorders);
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
