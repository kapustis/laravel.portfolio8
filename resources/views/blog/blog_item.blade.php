@extends('layouts.app')
@section('content')

    @include('blog.nav_bar')

    <section id="content">
        <blog-view :thread="{{ $thread }}" inline-template>
            <div v-if="editing">
                @include('blog.blog_item_edit')
            </div>
            <div v-else>
                <div class="blog_item">
                    <div class="post_preview">
                        <h2 class="post_title" v-text="title"></h2>
                        <div class="post_body2">
                            <img src="/img/1_b.jpeg" :alt="title">
                            <div class="post_text" v-html="body"></div>
                        </div>
                    </div>
                    <replies @added="repliesCount++" @removed="repliesCount--"></replies>
                </div>

                <div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p>
                                This thread was published {{ $thread->created_at->diffForHumans() }} by
                                <a href="#">{{$thread->creator->name}}</a> , and currently has
                                <span v-text="repliesCount"></span>
                                {{ Str::plural('comment',$thread->replies_count) }} .
                                {{ trans_choice('pluralization.replies_count',$thread->replies_count)}}
                            </p>
                            @if (auth()->check())
                                <p>
                                    <subscribe-button :active="{{json_encode($thread->isSubscribedTo)}}"></subscribe-button>
                                    <button type="button"
                                            class="button btn-danger"
                                            v-if="authorize('isAdmin')"
                                            @click="lockToggle"
                                            v-text="locked ? 'Unlock' : 'Lock'"
                                    ></button>
                                    <button type="button"
                                            class="button"
                                            v-if="authorize('owns', thread)"
                                            @click="editToggle"
                                    >Edit</button>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </blog-view>
    </section>
@stop
