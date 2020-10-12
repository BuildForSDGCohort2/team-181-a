<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'quantity',
        'item_type',
        'item_id'
    ];

    public function delete_cart()
    {
        foreach (Cart::where('user_id', Auth::id())->get() as $value) {
            $value->delete();
        }
    }
}
