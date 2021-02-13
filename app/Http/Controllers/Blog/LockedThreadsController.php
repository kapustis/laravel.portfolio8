<?php

namespace App\Http\Controllers\Blog;

use App\Models\BlogThread;

class LockedThreadsController extends BaseController
{
    /**
     * Lock the given thread.
     * Заблокировать данную тему.
     * @param BlogThread $thread
     */
    public function store(BlogThread $thread)
    {
        $thread->lock();
        $thread->update(['locked' => true]);
    }

    /**
     * Unlock the given thread.
     * Разблокировать данную тему.
     * @param BlogThread $thread
     */
    public function destroy(BlogThread $thread)
    {
        $thread->update(['locked' => false]);
    }
}
