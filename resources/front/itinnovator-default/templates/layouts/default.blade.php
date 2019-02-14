<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('_partials.head')
<body class="{{ $body_class }}">
    <div class="ui vertical inverted sidebar menu">
      <a class="active item">Home</a>
      <a class="item">Work</a>
      <a class="item">Company</a>
      <a class="item">Careers</a>
      <a class="item">Login</a>
      <a class="item">Signup</a>
    </div>
    <div class="pusher">
        <div id="app">
          @include('_partials.header')
          <main class="">
            @yield('content')
          </main>
          @include('_partials.footer')
        </div>
    </div>
    @include('_partials.footer-scripts')
</body>
</html>
