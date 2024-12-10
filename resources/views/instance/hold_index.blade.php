@extends('layout.master-inner')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header d-flex ">
            <h2>WhatsApp Instances</h2>
            <a href="{{  route('whatsapp.instance.add')}}" class="btn btn-primary flex-btn"> Add
                New</a>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">

                <div class="body table-responsive">
                    <table id="" class="table table-bordered table-striped table-hover dataTable">
                        <thead>
                            <tr>
                                <th data-data="name">Instance Id</th>
                                <th data-data="email">Token</th>
                                <th data-data="tac_code">Expiry</th>
                                <th data-data="tac_code">Actions</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th data-data="name">Instance Id</th>
                                <th data-data="email">Token</th>
                                <th data-data="tac_code">Expiry</th>
                                <th data-data="tac_code">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($instances as $instance)
                            <tr class="id_{{ @$instance->id }}">
                                <td data-data="name">{{ $instance->instance_id}}</td>
                                <td data-data="email">{{ $instance->instance_token}}</td>
                                <td data-data="tac_code">{{ $instance->instance_expiry}}</td>
                                <td>
                                    <a href="{{ route('whatsapp.instance.edit',$instance->id) }}"><i
                                            class="fa fa-edit text-primary" aria-hidden="true"></i></a>
                                    <a href="javascript:void(deleteInstance({{ @$instance->id }}))"> <i
                                            class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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
function deleteInstance(del_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/deleteInstance/' + del_id,
                type: 'get',
                success: function(response) {
                    // Handle the success response
                    if (response.status) {
                        $('.id_' + del_id).remove();
                    }
                },
                error: function(xhr) {
                    // Handle any errors
                    console.log('Error: ' + xhr.responseText);
                }
            });
        }
    });

}
</script>
@endpush