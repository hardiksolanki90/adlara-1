<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @if (count($css_files))
      @foreach ($css_files as $css)
        <link type="text/css" href="{{ $css }}" rel="stylesheet">
      @endforeach
    @endif
    <script type="text/javascript">
      CSRF = '{{ csrf_token() }}';
      CURRENT_URL = '{{ url()->current() }}';
      const ADMIN_URL = '{{ url(config('adlara.admin_route')) }}'
    </script>
</head>
<body class="logo-only">
    <div id="app" class="logo-only">
      <div class="logo">
        <div class="flex space-around">
          <img src="{{ media('logo2.png') }}" alt="">
        </div>
        <div class="_av flex space-around">
          {{ env('APP_VERSION') }}
        </div>
      </div>
      <main class="py-4">
          @yield('content')
      </main>
    </div>

    <!-- Scripts -->
    @if (count($js_files))
      @foreach ($js_files as $js)
        <script src="{{ $js }}"></script>
      @endforeach
    @endif
</body>
</html>
