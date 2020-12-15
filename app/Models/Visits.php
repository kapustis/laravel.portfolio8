<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Visits
{
    use HasFactory;

    private $thread;

    public function __construct($thread)
    {
        $this->thread = $thread;
    }

    protected function cacheKey()
    {
        return "threads.{$this->thread->id}.visits";
    }

    public function record()
    {
        Redis::incr($this->cacheKey());
    }

    public function reset()
    {
        Redis::del($this->cacheKey());
        return $this;
    }

    public function count()
    {
        return Redis::get($this->cacheKey()) ?? 0;
    }

}
