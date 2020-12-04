@extends('layouts.app')
@section('content')
    @include('blog.nav_bar')

    <section>
        <div class="tabs">
            <div class="tabs-menu">
                <ul class="tab">
                    <li><a href="/blog?popular=1">Лучшее</a></li>
                    <li><a href="/blog">Все подряд</a></li>
                </ul>
                <hr>
            </div>
        </div>
        <div class="list-group">
            <div class="post_list">
                @include ('blog._list')
            </div>
            <div class="sidebar">
                @if (count($trending))
                    <div class="panel-heading">Trending Threads</div>
                    <ul class="content_list">
                        @foreach($trending as $thread)
                            <li class="content_item">
                                <a href="{{ url($thread->path) }}">{{ $thread->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>
@endsection
