<?php

namespace App\Listeners;

use App\Events\ProductArrivalEvent;
use App\Mail\ArrivalNoticeMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendLineListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }
    /**
     * Handle the event.
     *
     * @param  ProductArrivalEvent  $event
     * @return void
     */
    public function handle(ProductArrivalEvent $event)
    {
		$notice = new \App\Http\Controllers\NoticeController;
		$notice->line();
    }
}