<?php

namespace App\Listeners;

use App\Events\SendingEvent;
use App\Mail\SendingMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendingListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendingEvent $event): void
    {
        Mail::to($event->email)->send(new SendingMail());
    }
}
