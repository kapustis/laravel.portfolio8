<nav class="navbar">
    @if (auth()->check())
        <ul>
{{--            <li><a href="{{ route('blog') }}">{{__('navs.navs-panel.all')}}</a></li>--}}
            <li><a href="/blog?by={{ auth()->user()->name }}">{{__('navs.navs-panel.my-records')}}</a></li>
{{--            <li><a href="{{url('/blog?popular=1')}}">{{__('navs.navs-panel.popular-threads')}}</a></li>--}}
            <li><a href="/blog?unanswered=1">{{__('navs.navs-panel.unanswered-threads')}}</a></li>
            <li><a href="{{ url('/blog/create') }}">{{__('navs.navs-panel.new-theme')}}</a></li>
        </ul>
    @endif
</nav>
