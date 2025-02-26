<?php

namespace App\Http\Controllers;

use App\Brood;
use App\Cart;
use App\Plantation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        $carts->transform(function($cart) {
            if ($cart->item_type =='PLT') {
            $item = Plantation::find($cart->item_id);
            } elseif ($cart->item_type =='POULT') {
                $item = Brood::find($cart->item_id);
            } elseif ($cart->item_type =='ANML') {}
                $cart->item = $item;
            return $cart;
        });
        return $carts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $cart = new Cart();

        $cart = Cart::where('user_id', Auth::id())->where('item_type', $request->item_type)->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            // return $data;
            // $cart =
            Cart::create($data);
        }
        return $cart;
        // $cart->updateOrCreate([
        //     'user_id' => Auth::id(),
        //     'item_id' => $request->id
        // ],[
        //     'quantity' => $request->qty,
        //     'item_type' => $request->item_type,
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
