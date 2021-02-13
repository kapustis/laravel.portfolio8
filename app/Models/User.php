<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * @method static create(array $array)
 **/
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar_path', 'name', 'login', 'email', 'password',
        'confirmation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'email'];

    /**
     * The attributes that should be cast to native types.
     * Атрибуты, которые следует приводить к собственным типам
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime', 'confirmed' => 'boolean'];

    /**
     * Mark the user's account as confirmed.
     * Отметить учетную запись пользователя как подтвержденную.
     */
    public function confirm()
    {
        $this->confirmed = true;
        $this->confirmation_token = null;
        $this->save();
    }

    /**
     * получить ключ маршрутом имя
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Выборка всех потоков, которые создавались пользователем
     *
     * @return HasMany
     */
    public function threads()
    {
        return $this->hasMany(BlogThread::class)->latest();
    }

    /**
     * Получить последний опубликованный ответ для пользователя
     *
     * @return HasOne|Builder
     */
    public function lastReply()
    {
        return $this->hasOne(BlogReply::class)->latest();
    }

    /**
     * Get all activity for the user.
     *
     * @return HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Get the cache key for when a user reads a thread.
     *
     * @param  $thread
     * @return string
     */
    public function visitedThreadCacheKey($thread)
    {
        return sprintf("users.%s.visits.%s", $this->id, $thread->id);
    }

    /**
     * Record that the user has read the given thread.
     *
     * @param $thread
     * @throws \Exception
     */
    public function read($thread)
    {
        cache()->forever($this->visitedThreadCacheKey($thread), Carbon::now());
    }

    /**
     * Get the path to the user's avatar.
     *
     * @param   $avatar
     * @return string
     */
    public function getAvatarPathAttribute($avatar)
    {
        if ($avatar) {
            return asset('storage/' . $avatar);
        }
        return asset('img/avatar.png');

    }

    /**
     * Determine if the user is an administrator.
     * Определить, является ли пользователь администратором
     * @return bool
     */
    public function isAdmin()
    {
        return in_array($this->name, ['Admin', 'UserOne']);
    }

}
