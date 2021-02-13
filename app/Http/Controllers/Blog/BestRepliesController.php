<?php

namespace App\Http\Controllers\Blog;

use App\Models\BlogReply;
use Illuminate\Auth\Access\AuthorizationException;

class BestRepliesController extends BaseController
{
    /**
     * Mark the best reply for a thread.
     * Отметить лучший ответ для обсуждения
     * @param  BlogReply $reply
     * @throws AuthorizationException
     */
    public function store(BlogReply $reply)
    {
        $this->authorize('update', $reply->thread);

        $reply->thread->markBestReply($reply);
    }
}
