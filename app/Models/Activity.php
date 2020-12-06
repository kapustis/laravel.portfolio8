<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
	use HasFactory;
    /**
     * Don't auto-apply mass assignment protection.
     * Снятие авто-защиты от массового присвоения.
     * @var array
     */
    protected $guarded = [];
    /**
     * Fetch the associated subject for the activity.
     * Получить связанный объект для активности.
     * @return MorphTo
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Fetch an activity feed for the given user.
     * Выберка действий для данного пользователя.
     * @param User $user
     * @param int $take
     * @return Collection;
     */
    public static function feed(User $user, $take = 50)
    {
        return static::where('user_id', $user->id)
            ->latest()
            ->with('subject')
            ->take($take)
            ->get()
            ->groupBy(function ($activity) {
                return $activity->created_at->format('Y-m-d');
            });
    }
}
