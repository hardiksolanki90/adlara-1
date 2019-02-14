@extends('layouts.dashboard')
@section('content')
<div class="m-datatable m-datatable--default m-datatable--brand m-datatable--loaded _tw">
  <div class="_tw_w">
    <table class="table table-striped _ft" id="table_test">
        <thead class="m-datatable__head">
          <tr class="m-datatable__row">
            <th class="m-datatable__cell m-datatable__cell--sort" filter="id">ID</th>
            <th class="m-datatable__cell m-datatable__cell--sort" filter="name">name</th>
            <th class="m-datatable__cell m-datatable__cell--sort">{{ t('Actions') }}</th>
          </tr>
          <tr class="filter"></tr>
        </thead>
        <tbody class="m-datatable__body">
          @include('test/_partials/list-only-test')
        </tbody>
      </table>
      <div class="links" table="table_test">
        {{ $obj->links() }}
      </div>

  </div>
</div>
@endsection
