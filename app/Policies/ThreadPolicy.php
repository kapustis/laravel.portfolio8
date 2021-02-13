<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BlogThread;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the thread.
     *
     * @param User $user
     * @param BlogThread $thread
     * @return mixed
     */
    public function update(User $user, BlogThread $thread)
    {
        return $thread->user_id == $user->id;
    }

}
