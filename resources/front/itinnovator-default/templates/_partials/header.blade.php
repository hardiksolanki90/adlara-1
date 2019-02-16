<!-- Following Menu -->
<div class="ui large top fixed hidden menu transition">
  <div class="ui container">
    <a href="{{ url('') }}" class="active item">Home</a>
    <a href="{{ url('work') }}" class="item">Work</a>
    <a href="{{ url('company') }}" class="item">Company</a>
    <a class="item">Careers</a>
    <div class="right menu">
      @if (Auth::check())
      <div class="item">
        <a href="{{ route('user.dashboard') }}" class="ui button">{{ t('Dashboard') }}</a>
      </div>
      <div class="item">
        <a href="{{ route('user.dashboard') }}" class="ui button">{{ t('Log out') }}</a>
      </div>
      @else
      <div class="item">
        <a href="{{ url('login') }} " class="ui button">{{ t('Log in') }}</a>
      </div>
      <div class="item">
        <a class="ui primary button">{{ t('Sign Up') }}</a>
      </div>
      @endif
    </div>
  </div>
</div>
<!-- Sidebar Menu -->
<!-- Page Contents -->
<div class="ui inverted vertical masthead center aligned segment">
  <div class="ui container">
    <div class="ui large secondary inverted pointing menu">
      <a class="toc item">
        <i class="sidebar icon"></i>
      </a>
      <a href="{{ url('') }}" title="logo" class="_logo">
        <img src="{{ media('logo_white.png') }}">
      </a>
      <a href="{{ url('') }}" class="item mb-0">Home</a>
      <a href="{{ url('work') }}" class="item mb-0">Work</a>
      <a href="{{ url('company') }}" class="item mb-0">Company</a>
      <a class="item mb-0">Careers</a>
      <div class="right item">
        @if (Auth::check())
          <a href="{{ route('user.dashboard') }}" class="ui inverted button">{{ t('Dashboard') }}</a>
          <a href="{{ route('logout') }}" class="ui inverted button">{{ t('Log out') }}</a>
        @else
          <a href="{{ url('login') }}" class="ui inverted button">{{ t('Log in') }}</a>
          <a href="{{ route('register') }}" class="ui inverted button">{{ t('Sign Up') }}</a>
        @endif
        <a href="https://github.com/jigeshraval/adlara" target="_blank" class="ui inverted button">
          <i class="github icon"></i>
          Github
        </a>
      </div>
    </div>
  </div>
</div>
