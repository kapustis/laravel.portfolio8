<?php

namespace App\Http\Controllers\Blog;

use App\Models\Thread;

class LockedThreadsController extends BaseController
{
    /**
     * Lock the given thread.
     * Заблокировать данную тему.
     * @param Thread $thread
     */
    public function store(Thread $thread)
    {
        $thread->lock();
        $thread->update(['locked' => true]);
    }

    /**
     * Unlock the given thread.
     * Разблокировать данную тему.
     * @param Thread $thread
     */
    public function destroy(Thread $thread)
    {
        $thread->update(['locked' => false]);
    }
}
