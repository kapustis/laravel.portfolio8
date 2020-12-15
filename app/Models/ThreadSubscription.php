<?php

namespace App\Models;

use App\Notifications\ThreadWasUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user
 * @property mixed thread
 */
class ThreadSubscription extends Model
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
        return $this->belongsTo(Thread::class);
    }

    /**
     * Notify the related user that the thread was updated.
     *
     * @param Reply $reply
     */
    public function notify(Reply $reply)
    {
        $this->user->notify(new ThreadWasUpdate($this->thread, $reply));
    }

}
