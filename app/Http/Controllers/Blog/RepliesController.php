<?php

namespace App\Http\Controllers\Blog;

use App\Http\Requests\CreatePostRequest;
use App\Models\BlogReply;
use App\Models\BlogThread;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class RepliesController extends BaseController
{
    /**
     * Create a new RepliesController instance.
     * Создайть новый экземпляр RepliesController
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  $channelId
     * @param BlogThread $thread
     * @return LengthAwarePaginator
     */
    public function index($channelId, BlogThread $thread)
    {
        return $thread->replies()->paginate(5);
    }

    /**
     * Persist a new reply.
     * Сохранить новый ответ
     * @param  $channelId
     * @param BlogThread $thread
     * @param CreatePostRequest $form
     * @return ResponseFactory|Model|Application|\Illuminate\Http\Response
     */
    public function store($channelId, BlogThread $thread, CreatePostRequest $form)
    {
        if ($thread->locked) {
            return response('Thread is locked', 422);
        }

        return $thread->addReply(['body' => request('body'), 'user_id' => auth()->id()])->load('owner');
    }

    /**
     * Обновить существующий ответ
     * @param BlogReply $reply
     * @return ResponseFactory|Response
     * @throws AuthorizationException
     */
    public function update(BlogReply $reply)
    {
        $this->authorize('update', $reply);

        try {
            $this->validate(request(), ['body' => 'required|spamfree']);
            $reply->update(request(['body']));
        } catch (Exception $e) {
            return response('Sorry, your reply could not be saved at this time.', 422);
        }
    }

    /**
     * Удалить данный ответ
     * @param BlogReply $reply
     * @return ResponseFactory|Application|RedirectResponse|Response
     * @throws Exception
     */
    public function destroy(BlogReply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();
        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted']);
        }

        return back();
    }

}
