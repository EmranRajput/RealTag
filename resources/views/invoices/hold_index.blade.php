@extends('layout.app')
@push('css')
<style>
.profile-img {
    width: 200px;
    height: 200px;
    box-shadow: 0px 0px 20px 5px rgba(100, 100, 100, 0.1);
}

.profile-img input {
    display: none;
}

.profile-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-img div {
    position: relative;
    height: 40px;
    margin-top: -40px;
    background: rgba(0, 0, 0, 0.5);
    text-align: center;
    line-height: 40px;
    font-size: 13px;
    color: #f5f5f5;
    font-weight: 600;
}

.profile-img div span {
    font-size: 40px;
}
</style>
@endpush
@section('content')
<section class="content profile-page">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12 p-l-0 p-r-0">
                <section class="boxs-simple">
                    <div class="d-flex">
                        <h4>Invoices</h4>
                        <a href="{{ route('invoices.edit.create')}}" class="create-new">
                            <button class="btn btn-primary  mb-2"> Create New</button></a>
                        <form action="{{ route('invoices.index') }}" method="GET" class="row">

                            <div class="col-md-8">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Search...">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                            </div>
                        </form>

                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Name</th>
                                <th>IC No/Identity No</th>
                                <th>Type</th>
                                <th>Tax</th>
                                <th>Total</th>
                                <th>Action</th>
                                <th>Download</th>
                                 <th>Status</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr class="delete_{{$invoice->id}}">
                                <td>{{ @$invoice->invoice_number }}</td>
                                <td>{!! @$invoice->name !!}</td>
                                <td>{!! @$invoice->identity_number !!}</td>
                                <td>{!! @$invoice->invoice_type !!}</td>
                                <td>{!! @$invoice->service_tax !!}</td>
                                <td>{!! @$invoice->total !!}</td>
                                <td>
                                    @if($invoice->status ==0) 
                                    <button class="deleteButton">
                                        <a href="{{ route('invoices.edit.create',$invoice->id)}}"  >
                                            <i class="fas fa-edit p-2"></i>
                                        </a>
                                    </button>
                                    <button class="deleteButton deleteButtons" data-id="{{ $invoice->id}}">
                                        <i class=" fas fa-trash text-danger p-2 "></i></button>
                                    @endif
                                    
                                    
                                        {{-- <a class="deleteButton downloadPdf" target="_blank" data-id="{{ @$invoice->id}}"
                                        href="{{ route('invoices.download.pdf',$invoice->id)}}">
                                        <i class="fas fa-file-invoice p-2"></i>

                                    </a> --}}
                                </td>

                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @if($invoice->status != 1) disabled="disabled" @endif>
                                            <i class="fas fa-file-invoice p-2" style="font-size:10px;"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('invoices.download.pdf',['id'=>$invoice->id,'type'=>'receipt'])}}"  >Receipt</a>
                                            <a class="dropdown-item" href="{{ route('invoices.download.pdf',['id'=>$invoice->id,'type'=>'invoice'])}}"  >Invoice</a>
                                        </div>
                                        </div>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if($invoice->status == 1)
                                            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Paid
                                            </button>
                                            @elseif($invoice->status == 2)
                                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Cancelled
                                            </button>
                                            @else
                                             <button type="button" class="btn  btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Unpaid
                                            </button>
                                            @endif
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item invoice-status" href="#" data-status="0" data-id="{{ $invoice->id }}">Unpaid</a>
                                                <a class="dropdown-item invoice-status" href="#" data-status="1" data-id="{{ $invoice->id }}">Paid</a>
                                                <a class="dropdown-item invoice-status" href="#" data-status="2" data-id="{{ $invoice->id }}">Cancelled</a>
                                            </div>
                                            </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
            {{ @$invoices->links()}}
        </div>
    </div>
</section>
@endsection
@push('script')
<script>

  $(document).ready(function() {
        $('.invoice-status').click(function() {
            // Get the data attributes of the clicked option
            var status = $(this).data('status');
            var id = $(this).data('id');
            var _url = "{{ route('invoices.change.status')}}";
            $.ajax({
                url:  _url,
                method: 'POST',
                data: {
                       status: status ,
                       id:id
                      },
                success: function(response) {
                     if (response.success) {
                        showAlert(1, response.success);
                    } else {
                        showAlert(0, response.error);
                    }
            location.reload();
                
                },
                error: function(error) {
                    
                }
            });
        });
 });
$(".deleteButtons").click(function() {
    var del_id = $(this).attr("data-id");
    var _url = "{{ route('invoices.delete')}}";
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
                type: "POST",
                url: _url,
                data: {
                    id: del_id
                },
                success: function(response) {
                    if (response.success) {

                        $('.delete_' + del_id).remove();
                        showAlert(1, "Invoice is removed");
                        // $('.message').addClass('text-success').text('Account is deleted.')
                    } else {
                        showAlert(0, "Action Failed! Please try again later.");
                        // $('.message').addClass('text-danger').text(
                        //     'Action Failed! Please try again later.')
                    }
                }
            });
        }
    });
});

$(document).on('click', '.activate', function() {
    var id = $(this).attr("data-id");
    var _url = "{{ route('agent.rental.agreement.active.deactive')}}";
    $.ajax({
        type: "POST",
        url: _url,
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {
                if (response.status == 1) {
                    showAlert(1, "Account is activated");
                    $('.is_active_' + id).html(
                        '<button class="btn btn-success activate" data-id="' +
                        id +
                        '"> Active</button>');
                } else if (response.status == 0) {
                    showAlert(1, "Account is deactivated");
                    $('.is_active_' + id).html(
                        '<button class="btn btn-danger activate" data-id="' +
                        id +
                        '"> Deactive</button>');
                }
            } else {
                showAlert(0, "Tanent is deactivate");
            }
        }
    });
});
</script>
@endpush