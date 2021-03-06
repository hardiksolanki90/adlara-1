@extends('layouts.dashboard')
@section('content')
<div class="con">  
  <div class="_tw card">
    <div class="_tw_w card-body">
      <table class="table table-striped _ft" id="table_performance_category">
        <thead>
          <tr>
            <th filter="id">ID</th>
            <th filter="name">name</th>
            <th filter="url">url</th>
            <th>{{ t('Actions') }}</th>
          </tr>
          <tr class="filter"></tr>
        </thead>
        <tbody class="m-datatable__body">
          @include('performance_category/_partials/list-only-performance_category')
        </tbody>
      </table>
      <div class="links" table="table_performance_category">
        {{ $obj->links() }}
      </div>
    
  </div>
</div>
</div>
@endsection
