@extends('layout.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>{!! $title !!}</h2>
      <small class="text-muted">Management</small>
    </div>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <div class="header">
            <h2>List of records </h2>
            @include('inc.list-header-actions', [
              'urlAdd' => $urlAdd
            ])
          </div>
          <div class="body table-responsive">
            <table id="{!! $table !!}" class="table table-bordered table-striped table-hover dataTable">
              <thead>
                <tr>
                  <th data-data="landlord_name">Landlord Name</th>
                  <th data-data="tenant_name">Tenant Name</th>
                  <th data-data="monthly_rent">Monthly Rent</th>
                  <th data-data="start_date">Start Date</th>
                  <th data-data="end_date">End Date</th>
                  <th data-data="deposite_amount">Deposite Ammount <br><small>(Security + Utility)</small></th>
                  <th data-data="agreement">Agreement</th>
                  <th data-data="status">Status</th>
                  <th data-data="created_at">Generated Date</th>
                  <th data-data="actions" data-sortable="false">Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Landlord Name</th>
                    <th>Tenant Name</th>
                    <th>Monthly Rent</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Deposite Ammount</th>
                    <th>Agreement</th>
                    <th>Status</th>
                    <th>Generated Date</th>
                    <th>Actions</th>
                </tr>
              </tfoot>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop
@push('script')
<script>
  jQuery(document).ready(function() {
    dtTable = applyDataTable('#{{$table}}', '{!! $urlListData ?? "" !!}', {});
  });
</script>
@endpush
