<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="meta_title" content="{{ $page['meta_title'] }}">
    <meta name="meta_description" content="{{ $page['meta_description'] }}">
    <meta name="meta_keywords" content="{{ $page['meta_keywords'] }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page['meta_title'] }}</title>

    <!-- Styles -->
    @if (count($css_files))
      @foreach ($css_files as $css)
        <link href="{{ $css }}" rel="stylesheet">
      @endforeach
    @endif

    <script>
      var URL = '{{ url('') }}';
      var CURRENT_URL = '{{ url()->current() }}';
      var CSRF = '{{ csrf_token() }}';
    </script>
</head>
