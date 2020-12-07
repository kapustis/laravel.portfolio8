<?php


namespace App\Filters;

use App\Models\User;

//use Illuminate\Http\Request;

class ThreadFilter extends Filters
{
    protected $filters = ['by', 'popular','unanswered'];

    /**
     * Отфильтровать запрос по указанному имени пользователя.
     * @param string $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('user_id', $user->id);
    }


    /**
     * Отфильтровать запрос по популярности темы
     *
     * @return $this
     */
    protected function popular()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'desc');
    }

    /**
     * Отфильтровать запрос по популярности темы
     *
     * @return $this
     */
    protected function unanswered()
    {
        return $this->builder->where('replies_count', 0);
    }
}
