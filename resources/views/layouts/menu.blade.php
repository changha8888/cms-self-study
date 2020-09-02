
<li class="nav-item {{ Request::is('news*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('news.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>News</span>
    </a>
</li>



<li class="nav-item {{ Request::is('tests*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('tests.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Tests</span>
    </a>
</li>

<li class="nav-item {{ Request::is('posts*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('posts.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Posts</span>
    </a>
</li>
