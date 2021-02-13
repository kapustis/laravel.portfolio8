<?php

namespace App\Http\Controllers\Blog;

use App\Models\BlogThread;
use Illuminate\Http\Request;

class ThreadSubscriptionController extends BaseController
{
    /**
     * Store a new thread subscription.
     *
     * @param $channelId
     * @param BlogThread $thread
     * @return void
     */
    public function store($channelId , BlogThread $thread)
    {
        $thread->subscribe();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $channelId
     * @param BlogThread $thread
     * @return void
     */
    public function destroy($channelId , BlogThread $thread)
    {
        $thread->unsubscribe();
    }

}
