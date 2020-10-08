<?php

namespace App\Observers;

use App\Issues;
use App\Sms;
use App\User;

class IssuesObserver
{
    /**
     * Handle the issues "created" event.
     *
     * @param  \App\Issues  $issues
     * @return void
     */
    public function created(Issues $issues)
    {

        $user = User::find($issues->user_id);

        // Log::debug($issues);

        $sms = new Sms;
        // $phone = '+254768187628';
        $phone = '+254731090832';
        $message = 'Test sms';
        //    return $sms = $sms->send($message, $phone);

        if ($user) {
            $sms = new Sms;
            // $phone = $user->phone;
            if ($phone) {
                $message = 'Dear ' . $user->name . ' ' . $issues->information;
                $sms = $sms->send($phone, $message);
            }
        }

    }

    /**
     * Handle the issues "updated" event.
     *
     * @param  \App\Issues  $issues
     * @return void
     */
    public function updated(Issues $issues)
    {
        //
    }

    /**
     * Handle the issues "deleted" event.
     *
     * @param  \App\Issues  $issues
     * @return void
     */
    public function deleted(Issues $issues)
    {
        //
    }

    /**
     * Handle the issues "restored" event.
     *
     * @param  \App\Issues  $issues
     * @return void
     */
    public function restored(Issues $issues)
    {
        //
    }

    /**
     * Handle the issues "force deleted" event.
     *
     * @param  \App\Issues  $issues
     * @return void
     */
    public function forceDeleted(Issues $issues)
    {
        //
    }
}
