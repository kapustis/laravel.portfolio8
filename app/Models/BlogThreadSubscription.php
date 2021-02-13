<?php

namespace App\Models;

use App\Notifications\ThreadWasUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user
 * @property mixed thread
 */
class BlogThreadSubscription extends Model
{
    use HasFactory;

    /**
     * Don't auto-apply mass assignment protection.
     * Снятие авто-защиты от массового присвоения.
     * @var array
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(BlogThread::class);
    }

    /**
     * Notify the related user that the thread was updated.
     *
     * @param BlogReply $reply
     */
    public function notify(BlogReply $reply)
    {
        $this->user->notify(new ThreadWasUpdate($this->thread, $reply));
    }

}
