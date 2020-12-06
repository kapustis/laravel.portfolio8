<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @property mixed $threads
 * @property mixed id
 * @property mixed exist
 */
class Channel extends Model
{
	use HasFactory;

    /**
     * Don't auto-apply mass assignment protection.
     * Снятие авто-защиты от массового присвоения.
     * @var array
     */
    protected $guarded = [];
    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * A channel consists of threads.
     *
     * @return HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
