<?php

namespace App\Policies;

use App\Models\BlogReply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function update(User $user, BlogReply $reply)
    {
        return $reply->user_id == $user->id;
    }

    public function create(User $user)
    {
        if (! $lastReply = $user->fresh()->lastReply) {
            return true;
        }

        return ! $lastReply->wasJustPublished();
    }

}
