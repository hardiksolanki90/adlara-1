@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="_tw card">
    <div class="_tw_w card-body">
      <table class="table table-striped _ft" id="table_countries">
        <thead>
          <tr>
            <th filter="id">ID</th>
            <th filter="name">Name</th>
            <th filter="iso_code">Iso Code</th>
            <th>{{ t('Actions') }}</th>
          </tr>
          <tr class="filter"></tr>
        </thead>
        <tbody class="m-datatable__body">
          @include('countries/_partials/list-only-countries')
        </tbody>
      </table>
      <div class="links" table="table_countries">
        {{ $obj->links() }}
      </div>
    
  </div>
</div>
</div>
@endsection
