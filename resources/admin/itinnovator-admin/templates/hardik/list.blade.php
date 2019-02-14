@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="_tw card">
    <div class="_tw_w card-body">
      <table class="table table-striped _ft" id="table_hardik">
        <thead>
          <tr>
            <th filter="id">ID</th>
            <th filter="name">Name</th>
            <th filter="phone">Phone</th>
            <th>{{ t('Actions') }}</th>
          </tr>
          <tr class="filter"></tr>
        </thead>
        <tbody class="m-datatable__body">
          @include('hardik/_partials/list-only-hardik')
        </tbody>
      </table>
      <div class="links" table="table_hardik">
        {{ $obj->links() }}
      </div>
    
  </div>
</div>
</div>
@endsection
