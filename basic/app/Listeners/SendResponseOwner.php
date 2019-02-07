<?php

namespace App\Listeners;

use App\Events\MessageWasReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Mail;

class SendResponseOwner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageWasReceived  $event
     * @return void
     */
    public function handle(MessageWasReceived $event)
    {
        //
        $message = $event->message;
        Mail::send('emails.contact',['mensaje' => $message],function ($m) use($message){
            $m->from($message->email, $message->name)
                ->to('cjmar87@gmail.com','Carlos Martín')
                ->subject('tu mensaje fue recibido');
        });
    }
}
