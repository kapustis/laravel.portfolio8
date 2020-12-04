<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Auth\Access\AuthorizationException;

class BestRepliesController extends Controller
{
    /**
     * Mark the best reply for a thread.
     * Отметить лучший ответ для обсуждения
     * @param  Reply $reply
     * @throws AuthorizationException
     */
    public function store(Reply $reply)
    {
        $this->authorize('update', $reply->thread);

        $reply->thread->markBestReply($reply);
    }
}
