<nav class="navbar">
    @if (auth()->check())
        <ul>
            <li><a href="{{ route('blog') }}">All Threads</a></li>
            <li><a href="/blog?by={{ auth()->user()->name }}">Мои записи</a></li>
            <li><a href="/blog?popular=1">Popular Threads</a></li>
            <li><a href="/blog?unanswered=1">Unanswered Threads</a></li>
            <li><a href="{{ url('/blog/create') }}">Новая тема</a></li>
        </ul>
    @endif
</nav>
