<?php

namespace App\Listeners;

use App\Events\PendingEvent;
use App\Mail\PendingMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PendingListener implements ShouldQueue
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
    public function handle(PendingEvent $event): void
    {
        Mail::to($event->email)->send(new PendingMail());
    }
}
