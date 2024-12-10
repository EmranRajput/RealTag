@extends('layout.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>{!! $title !!}</h2>
      <small class="text-muted">Message Template</small>
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
                  <th data-data="name">Name</th>
                  <th data-data="type">Template Type</th>
                  <th data-data="status">Status</th>
                  <th data-data="created_at">Created at</th>
                  <th data-data="actions" data-sortable="false">Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Template Type</th>
                  <th>Status</th>
                  <th>Created at</th>
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
