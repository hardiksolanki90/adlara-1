<!-- Scripts -->
@if (count($js_files))
  @foreach ($js_files as $js)
    <script src="{{ $js }}"></script>
  @endforeach
@endif
