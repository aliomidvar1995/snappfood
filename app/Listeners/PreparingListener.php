<?php

namespace App\Listeners;

use App\Events\PreparingEvent;
use App\Mail\PreparingMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PreparingListener
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
    public function handle(PreparingEvent $event): void
    {
        Mail::to($event->email)->send(new PreparingMail());
    }
}
