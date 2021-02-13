<?php

namespace App\Http\Controllers\Blog;

use App\Models\BlogReply;

class FavoritesController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new favorite in the database.
     * Сохранение нового избранного в базе данных
     * @param  BlogReply $reply
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
     */
    public function store(BlogReply $reply)
    {
         $reply->favorite();
         return back();
    }

    /**
     * Delete the favorite.
     * Удалить избранное
     * @param BlogReply $reply
     */
    public function destroy(BlogReply $reply)
    {
        $reply->unfavorite();
    }
}
