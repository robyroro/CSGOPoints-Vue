<?php

namespace App\Listeners;

use App\Events\NewRecentFeeds;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFeedNotification
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
     * @param  \App\Events\NewRecentFeeds  $event
     * @return void
     */
    public function handle(NewRecentFeeds $event)
    {
        //
    }
}
