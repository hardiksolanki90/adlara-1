@extends('layouts.default')
@section('content')
@if ($current_page->name == 'Home Page')
<div class="content">
  {!! filter($current_page->content) !!}
</div>
@else
<div class="content ui container">
  {!! filter($current_page->content) !!}
</div>
@endif
@endsection
