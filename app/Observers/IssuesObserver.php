<?php

namespace App\Observers;

use App\Isues;
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
    public function created(Isues $isues)
    {
        return;
        $user = User::find($isues->user_id);

        // Log::debug($isues);

        $sms = new Sms;
        $phone = '+254768187628';
        // $phone = '+254731090832';
        $message = 'Test sms';
        //    return $sms = $sms->send($message, $phone);

        if ($user) {
            $sms = new Sms;
            // $phone = $user->phone;
            if ($phone) {
                $message = 'Dear ' . $user->name . ' ' . $isues->information;
                $sms = $sms->send($phone, $message);
            }
        }

    }
}
