<?php

namespace App\Listeners;

use App\Events\DeliveredEvent;
use App\Mail\DeliveredMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class DeliveredListener
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
    public function handle(DeliveredEvent $event): void
    {
        Mail::to($event->email)->send(new DeliveredMail());
    }
}
