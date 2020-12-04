
    <ul class="content_list">
        @forelse($threads as $thread)
            <li class="content_item">
                <article class="post_preview">
                    <header class="post_meta">
                        <a href="{{route('profile',$thread->creator)}}" class="user_info" title="avtor">
                            <span class="user_nick">{{$thread->creator->name}}</span>
                        </a>
                        <span class="post_time">{{$thread->created_at}}</span>
                    </header>
                    <h2 class="post_title">
                        <a href="{{ $thread->path() }}">
                            @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                <strong style="color: #0e6a62">{{$thread->title}}</strong>
                            @else
                                {{$thread->title}}
                            @endif
                        </a>
                    </h2>
                    <div class="post_body">
                        <div class="post_text">
                            <p><img src="/img/1_b.jpeg" alt="{{$thread->title}}"></p>
                            <p> {!! stristr($thread->body, '</div>' ,true) !!}</p>
                        </div>
                    </div>
                    <a href="{{ $thread->path() }}" class="button" style="left: 0">Читать дальше →</a>
                    <div class="post_footer">
                        <ul class="post_stat">
                            <li class="post_item">
                                <button type="button" class="button bookmark_button">
                                    <span>
                                         <i class="fas fa-bookmark icon" aria-hidden="true"></i>
                                         <span class="counter">{{$thread->bookmark}}</span>
                                    </span>
                                </button>
                            </li>
                            <li class="post_item">
                                <div class="post_g">
                                 <span>
                                    <i class="fa fa-eye icon" aria-hidden="true"></i>
                                     <span class="counter">{{$thread->views}}</span>
                                 </span>
                                </div>
                            </li>
                            <li class="post_item">
                                <div class="post_comment">
                                    <a href="{{$thread->path()}}" class="comment_link">
                                        <i class="far fa-comments" aria-hidden="true"></i>
                                        <span class="counter">{{$thread->replies_count}}</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </article>
            </li>
        @empty
            <p>Нет соответствующих результатов в это время</p>
            <p>There are no relevant results at this time.</p>
        @endforelse
    </ul>
    {{ $threads->links('vendor/pagination/default') }}

