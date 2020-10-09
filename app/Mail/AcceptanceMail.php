<?php

namespace App\Mail;

use App\Proffesional;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;


class AcceptanceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $new_user;

    public function __construct(Proffesional $new_user)
    {
        $this->new_user = $new_user;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {  
        return $this->from('thhefarmersassistant@gmail.com')
        ->subject('Youve Been Selected!!')
        ->markdown('mail.confirm')->with(['new_user' =>$this->new_user]);
    }
}
