<?php

namespace App\Listeners;

use App\Events\PayEvent;
use App\Mail\PayMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PayListener implements ShouldQueue
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
    public function handle(PayEvent $event): void
    {
        Mail::to($event->email)->send(new PayMail());
    }
}
