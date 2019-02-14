<div class="sidebar">
  <ul class="navbar-nav">
    <li class="nav-item _logo_">
      <img src="https://v56.adlara.com/storage/media/image/logo_white.png" alt="">
    </li>
    {{--
    <li class="nav-item">
      <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
    </li>
    --}}
    @if (count($sidebar_menu))
      @foreach ($sidebar_menu as $k => $head)
        <li class="_h">{{ $head->name }}</li>
        @if (count($head->menu))
          @foreach ($head->menu as $key => $m)
            <li class="nav-item">
              <a href="{{ ($m->slug && Route::has($m->slug) ? route($m->slug) : '#') }}" class="nav-link">
                {{ $m->name }}
              </a>
              @if (count($m->child))
              <ul class="submenu">
                @foreach ($m->child as $child)
                  @if (Route::has($child->slug))
                  <li class="nav-item">
                    <a class="item-link" href="{{ route($child->slug) }}">{{ $child->name }}</a>
                  </li>
                  @endif
                @endforeach
              </ul>
              @endif
            </li>
          @endforeach
        @endif
      @endforeach
    @endif
  </ul>
</div>
