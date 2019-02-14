@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="_tw card">
    <div class="_tw_w card-body">
      <table class="table table-striped _ft" id="table_post_user">
        <thead>
          <tr>
            <th filter="id">ID</th>
            <th filter="full_name">Full Name</th>
            <th filter="email">Email</th>
            <th filter="countries.name">Country</th>
            <th>{{ t('Actions') }}</th>
          </tr>
          <tr class="filter"></tr>
        </thead>
        <tbody class="m-datatable__body">
          @include('post_user/_partials/list-only-post_user')
        </tbody>
      </table>
      <div class="links" table="table_post_user">
        {{ $obj->links() }}
      </div>
    
  </div>
</div>
</div>
@endsection
