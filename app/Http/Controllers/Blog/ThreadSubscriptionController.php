<?php

namespace App\Http\Controllers\Blog;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadSubscriptionController extends BaseController
{
    /**
     * Store a new thread subscription.
     *
     * @param $channelId
     * @param Thread $thread
     * @return void
     */
    public function store($channelId , Thread $thread)
    {
        $thread->subscribe();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $channelId
     * @param Thread $thread
     * @return void
     */
    public function destroy($channelId ,Thread $thread)
    {
        $thread->unsubscribe();
    }

}
