@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="_tw card">
    <div class="_tw_w card-body">
      <table class="table table-striped _ft" id="table_theatre_owner">
        <thead>
          <tr>
            <th filter="id">ID</th>
            <th filter="name">Name</th>
            <th filter="email">Email</th>
            <th filter="performance_category.name">Category</th>
            <th>{{ t('Actions') }}</th>
          </tr>
          <tr class="filter"></tr>
        </thead>
        <tbody class="m-datatable__body">
          @include('theatre_owner/_partials/list-only-theatre_owner')
        </tbody>
      </table>
      <div class="links" table="table_theatre_owner">
        {{ $obj->links() }}
      </div>
    
  </div>
</div>
</div>
@endsection
