<?php

namespace App\Http\Controllers\Blog;


use App\Http\Requests\ThreadsCreateRequest;
use App\Models\BlogChannel;
use App\Models\BlogThread;
use App\Models\Trending;
use App\Filters\ThreadFilter;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ThreadsController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Fetch all relevant threads.
     * Получить все соответствующие потоки
     * @param BlogChannel $channel
     * @param ThreadFilter $filters
     * @return mixed
     */
    public function getThreads(BlogChannel $channel, ThreadFilter $filters)
    {
        $threads = BlogThread::with('channel')->with('creator')->latest()->filter($filters);
        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }
//        dd($threads->toSql());
        return $threads->paginate(5);

    }

    /**
     * Display a listing of the resource.
     * Отобразить список ресурсов.
     * @param BlogChannel $channel
     * @param ThreadFilter $filters
     * @param Trending $trending
     * @return Factory|Application|\Illuminate\Http\Response|View
     */
    public function index(BlogChannel $channel, ThreadFilter $filters, Trending $trending)
    {
        $threads = $this->getThreads($channel, $filters);
        if (\request()->wantsJson()) {
            return $threads;
        }

        return view('blog.blog', ['threads' => $threads, 'trending' => $trending->get()]);

    }

    /**
     * Show the form for creating a new resource.
     * Показать форму для создания нового ресурса.
     * @return Factory|Application|\Illuminate\Http\Response|View
     */
    public function create()
    {
        $item = BlogThread::make();

        return view('blog.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ThreadsCreateRequest $request
     * @return Application|RedirectResponse|\Illuminate\Http\Response|Redirector
     */
    public function store(ThreadsCreateRequest $request)
    {
        $data = $request->input();
        $data = \Arr::add($data, 'user_id', auth()->id());
        $thread = BlogThread::create($data);

        if ($thread) {
            return redirect($thread->path())->with('flash', 'Your thread has been published');
        }
        return back()->withErrors(['flash' => 'Save error'])->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param $channel
     * @param BlogThread $thread
     * @param Trending $trending
     * @return BlogThread|Factory|Application|View
     */
    public function show($channel, BlogThread $thread, Trending $trending)
    {
        if (auth()->check()) auth()->user()->read($thread);
        $thread->increment('views');
        $trending->push($thread);
        return view('blog.blog_item', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $channel
     * @param BlogThread $thread
     * @return BlogThread
     * @throws AuthorizationException
     */
    public function update($channel, BlogThread $thread)
    {
        $this->authorize('update', $thread);

        $thread->update(request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]));

        return $thread;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $channel
     * @param BlogThread $thread
     * @return ResponseFactory|Application|\Illuminate\Http\Response|Response
     * @throws Exception
     */
    public function destroy($channel, BlogThread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }
        return back();
    }
}
