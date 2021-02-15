<?php

namespace App\Http\Controllers\Blog;

use App\Models\Reply;

class FavoritesController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new favorite in the database.
     * Сохранение нового избранного в базе данных
     * @param  Reply $reply
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
     */
    public function store(Reply $reply)
    {
         $reply->favorite();
         return back();
    }

    /**
     * Delete the favorite.
     * Удалить избранное
     * @param Reply $reply
     */
    public function destroy(Reply $reply)
    {
        $reply->unfavorite();
    }
}
