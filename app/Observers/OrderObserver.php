<?php

namespace App\Observers;

use App\Order;
use App\Sms;
use App\User;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function created(Order $order)
    {

        // Log::debug($order);

        $sms = new Sms;
        $phone = '+254768187628';
        // $phone = '+254731090832';
        $message = 'Test sms';
        //    return $sms = $sms->send($message, $phone);

        $user = User::find($order->seller_id);
        if ($user) {
            $sms = new Sms;
            // $phone = $user->phone;
            if ($phone) {
                $message = 'Dear ' . $user->name . ' you have a new order';
                $sms = $sms->send($phone, $message);
            }
        }

    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
