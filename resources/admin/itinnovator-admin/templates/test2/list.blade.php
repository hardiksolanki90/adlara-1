@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="_tw card">
    <div class="_tw_w card-body">
      <table class="table table-striped _ft" id="table_test2">
        <thead>
          <tr>
            <th filter="id">ID</th>
            <th filter="name">Name</th>
            <th filter="location">Location</th>
            <th>{{ t('Actions') }}</th>
          </tr>
          <tr class="filter"></tr>
        </thead>
        <tbody class="m-datatable__body">
          @include('test2/_partials/list-only-test2')
        </tbody>
      </table>
      <div class="links" table="table_test2">
        {{ $obj->links() }}
      </div>
    
  </div>
</div>
</div>
@endsection
