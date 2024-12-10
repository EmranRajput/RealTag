@extends('layout.app')
@push('css')
@include('rentalAgreememt.show')
<!-- Example Blade File -->


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
.container-fluid span{
    margin-left : 5px;
}
</style>
@endpush
@section('content')

<section class="content profile-page">
    <div class="container-fluid">
        <div class="row clearfix">
            <form action="{{ route('agent.rental.agreements') }}" method="GET" class="row" id="filter_form">
            <!--search filters-->
            <div class="col-sm-3 ">
                <label for="first_name">Tenant Account Name</label>
                <div class="form-group">
                    <div class="form-line">
                        <select class="form-control select-tenant" id="exampleSelect"  name="tenant_id">
                            <option value="">Select Tenant</option>
                            @if($tanents)
                                @foreach($tanents as $tenant)
                                    <option value="{{ $tenant->id }}" @if(request('tenant_id') == $tenant->id) selected  @endif> {{ $tenant->name }} </option>
                                @endforeach
                            @endif
                        </select>

                    </div>
                </div>
            </div>
             <div class="col-sm-3">
                <label for="first_name">Landlord Account Name</label>
                <div class="form-group">
                    <div class="form-line">
                        <select class="form-control select-landlord" id="exampleSelect" name="landlord_id">
                            <option value="">Select Landlord</option>
                             @if($landlords)
                                    @foreach($landlords as $landlord)
                                        <option value="{{$landlord->id}}" @if(request('landlord_id') == $landlord->id) selected @endif>{{$landlord->name}}</option>                            
                                     @endforeach      
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            
                <div class="col-sm-3">
                    <label for="first_name">Rental Address</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" class="rental_amount form-control" name="address" value="{{ request('address') }}">
                        </div>
                    </div>
                </div>

                 <div class="col-sm-3">
                    <label for="first_name">Select Date Range</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="date_range" class="form-control" name="dates"
                                value="{{ request('dates') }}">
                        </div>
                    </div>
                </div>
                <div class="">
                
                <button type="submit" class="btn btn-success ml-3 mb-4"> Show on screen</button>
                <a href="" class="create-new">
                <a class="btn btn-danger  mb-4" href="{{ route('agent.rental.agreements') }}"> Reset Filter</a>
                <a href="" class="create-new">
                <button class="btn btn-primary  mb-4">Export CSV</button></a> 
                <a href="" class="create-new">
                <button class="btn btn-info  mb-4"> Export PDF</button></a>
                            
             </div>
             </form>
             
                              <!--end search filters  -->
            <div class="col-md-12 p-l-0 p-r-0">
                <section class="boxs-simple">
                    <div class="d-flex">
                        <h4>Rental Agreements</h4>
                        <a href="{{ route('agent.rental.agreement.edit')}}" class="create-new">
                            <button class="btn btn-primary  mb-2"> Create New</button></a>
                        <form action="{{ route('agent.rental.agreements') }}" method="GET" class="row">

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
                                <th>Landlord</th>
                                <th>Tenant</th>
                                <th>Address</th>
                                <th>Rental Amount</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Security Deposit</th>
                                <th>Utility Deposit</th>

                                {{-- @if(auth()->guard(userGuard())->user()->role == 1) --}}
                                <th>Action</th>
                                {{-- @endif --}}
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agreements as $agreement)
                            <tr class="delete_{{$agreement->id}}">
                                <td>{{ @$agreement->landlord->name }}</td>
                                <td>{!! @$agreement->tenant->name !!}</td>
                                <td>{!! @$agreement->address !!}</td>
                                <td>{!! @$agreement->rental_amount !!}</td>
                                <td>{!! @$agreement->start_date !!}</td>
                                <td>{!! @$agreement->end_date !!}</td>
                                <td>{!! @$agreement->security_deposit !!}</td>
                                <td>{!! @$agreement->utility_deposit !!}</td>
                                <td>
                                @if(auth()->guard(userGuard())->user()->role == 1)
                                    
                                    <button class="deleteButton">
                                        <a href="{{ route('agent.rental.agreement.edit',$agreement->id)}}">
                                            <i class="fas fa-edit p-2"></i>
                                        </a>
                                    </button>
                                      @endif
                                      @if($agreement->invoiceID != "" && $agreement->invoiceStatus ==0)
                                        <button class="invoice deleteButton">
                                            <a href="{{ route('invoices.edit.create',$agreement->invoiceID)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </button>
                                      @elseif($agreement->invoiceStatus != 0)
                                        <button class="invoice deleteButton">
                                            <a href="{{ route('invoices.index')}}">
                                                <i class="fa fa-list"></i>
                                            </a>
                                        </button>
                                      @else
                                        <button class="invoice deleteButton">
                                            <a href="{{ route('agent.rental.agreement.createinvoice',$agreement->id)}}">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </button>
                                      @endif
                                      
                                    
                                    <button class="deleteButton deleteButtons" data-id="{{ $agreement->id}}">
                                        <i class=" fas fa-trash text-danger "></i>
                                    </button>
                                    <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">-->
                                    <!--    <i class=" fas fa-eye "></i> </button>-->
                                     
                                    <button  class="deleteButton  show"  data-id="{{ @$agreement->id}}" >
                                        <i class="fas fa-eye"></i>
                                    </button>
                                        
                                </td>
                              
                                <td class="is_active_{{@$agreement->id}}">
                                    @if($agreement->status == 1)
                                    <button class="btn btn-success activate" data-id="{{ @$agreement->id}}">
                                        Active</button>
                                    @else
                                    <button class="btn btn-danger activate" data-id="{{ @$agreement->id}}">
                                        Deactive</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
            {{ @$agreements->links()}}
            
        </div>
    </div>
   
</section>
    <!--// view model Popup -->

<!-- The Modal -->
<div class="modal fade" id="myModal123">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header shadow-sm">
        <h3 class="modal-title ml-3">Agreement Details</h3>
        <button type="button" class="btn btn-primary ml-4 pull-right" style="    margin-left: 69% !important;margin-top: -5px;"  id="agrement1_id"><i class="fa fa-print"></i></button>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <!-- Left Side Content -->
            <div class="col-md-6">
<!-- Example usage in modal body -->
             <p><strong>Tenant Name:</strong><span id="tenant_name"></span></p>
              <p><strong>Tenant IC No:</strong><span id="tenant_ic_no"></span></p>
              </div>
              <div class="col-md-6">
              <p><strong>Landlord Name:</strong><span id="landlord_name"></span></p>
              <p><strong>Landlord IC No:</strong><span id="landlord_ic_no"></span></p>
              </div>
            </div>
            <div class="row">
             <div class="col-md-6">
              <p><strong>Agent Name:</strong> <span id="agent_name"></span></p>
              <p><strong>Rental Address:</strong><span id="rental_address"></span></p>
              <p><strong>Start Date:</strong><span id="rental_startdate"></span></p>
              <p><strong>End Date:</strong><span id="rental_enddate"></span></p>
              <p><strong>Agent Service:</strong><span id="rental_agent_services"></span></p>
              </div>
              <div class="col-md-6">
            <!-- Right Side Content -->
              <p><strong>Rental Amount:</strong><span id="rental_amount"></span> per month</p>
              <p><strong>Security Deposit:</strong><span id="rental_security_deposit"></span></p>
              <p><strong>Utility Deposit:</strong><span id="rental_utility_deposit"></span></p>
              <p><strong>Duration:</strong>  <span id="rental_duration"></span> months</p>
              <p><strong>Status:</strong>  <span id="rental_status"></span></p>
              </div>
              </div>
          </div>
        </div>

            <!-- Modal Footer -->
            <!--<div class="shadow-sm ">-->
                
            <!--</div>-->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>

            </div>
        </div>
    </div>
</div>
<input name="agrement_id" id="agrement_id" type="hidden">
@endsection
@push('script')
<script>
$(".deleteButtons").click(function() {
    var del_id = $(this).attr("data-id");
    var _url = "{{ route('agent.rental.agreement.delete')}}";
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
                        showAlert(1, "Rental Agreement is removed");
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
                    showAlert(1, "Rental Agreement is activated");
                    $('.is_active_' + id).html(
                        '<button class="btn btn-success activate" data-id="' +
                        id +
                        '"> Active</button>');
                } else if (response.status == 0) {
                    showAlert(1, "Rental Agreement is deactivated");
                    $('.is_active_' + id).html(
                        '<button class="btn btn-danger activate" data-id="' +
                        id +
                        '"> Deactive</button>');
                }
            } else {
                showAlert(0, "Rental Agreement is deactivate");
            }
        }
    });
});

$(".show").on('click', function() {
    var id = $(this).attr("data-id");
    var _url = "{{ route('agent.rental.agreement.show')}}";
    $.ajax({
        type: "POST",
        url: _url,
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {
                var tenant = response.data.tenant[0]; // Access the first tenant if it exists
                // var = 
                if(response.data.agreement.status!=1){
                    var sstatus = "Deactivated";   
                }else{
                    var sstatus = "Active";
                }
                if(response.data.agreement.agent_service!=1){
                    var dstatus = "No";   
                }else{
                    var dstatus = "Yes";
                }
                $("#tenant_name").text(tenant ? tenant.name : '');
                $("#tenant_ic_no").text(tenant ? tenant.ic_number : '');
                $("#landlord_name").text(response.data.landlord[0].name);
                $("#landlord_ic_no").text(response.data.landlord[0].ic_number);
                $("#agent_name").text(response.data.agent[0].name);
                $("#rental_address").text(response.data.agreement.address);
                $("#rental_startdate").text(response.data.agreement.start_date);
                $("#rental_enddate").text(response.data.agreement.end_date);
                $("#rental_agent_services").text(dstatus);
                $("#rental_amount").text("$"+response.data.agreement.rental_amount);
                $("#rental_security_deposit").text("$"+response.data.agreement.security_deposit);
                $("#rental_utility_deposit").text("$"+response.data.agreement.utility_deposit);
                $("#rental_duration").text(response.data.agreement.duration);
                $("#rental_status").text(sstatus);
                $("#agrement_id").val(response.data.agreement.agreement_id);
                $('#myModal123').modal('show');
                
            } else {
                showAlert(0, "Rental Agreement is deactivate");
            }
        }
    });
});



</script>
<!--date range picker -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-daterangepicker@3.0.5/daterangepicker.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-daterangepicker@3.0.5/daterangepicker.css">
<!--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>-->

<!--<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>-->

<!-- Initialize the date range picker -->
<script>
    $(document).ready(function () {
        $('#date_range').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#date_range').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ',' + picker.endDate.format('YYYY-MM-DD'));
            $("#filter_form").submit();
        });

        $('#date_range').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
        
        $(document).on('click', '#agrement1_id', function() {
            var _url = "{{ route('agent.rental.agreement.parse')}}";
            var tenant_name = document.getElementById("tenant_name").textContent;
            var tenant_ic_no = document.getElementById("tenant_ic_no").textContent;
            var landlord_name = document.getElementById("landlord_name").textContent;
            var landlord_ic_no = document.getElementById("landlord_ic_no").textContent;
            var agent_name = document.getElementById("agent_name").textContent;
            var rental_address = document.getElementById("rental_address").textContent;
            var rental_startdate = document.getElementById("rental_startdate").textContent;
            var rental_enddate = document.getElementById("rental_enddate").textContent;
            var rental_agent_services = document.getElementById("rental_agent_services").textContent;
            var rental_amount = document.getElementById("rental_amount").textContent;
            var rental_security_deposit = document.getElementById("rental_security_deposit").textContent;
            var rental_utility_deposit = document.getElementById("rental_utility_deposit").textContent;
            var rental_duration = document.getElementById("rental_duration").textContent;
            var rental_status = document.getElementById("rental_status").textContent;
            var agrement_id = document.getElementById("agrement_id").value;
            var jsonObject = {
                    "tenant_name": tenant_name,
                    "tenant_ic_no": tenant_ic_no,
                    "landlord_name": landlord_name,
                    "landlord_ic_no": landlord_ic_no,
                    "agent_name": agent_name,
                    "rental_address": rental_address,
                    "rental_start_date": rental_startdate,
                    "rental_end_date": rental_enddate,
                    "rental_agent_services": rental_agent_services,
                    "rental_amount": rental_amount,
                    "rental_security_deposit": rental_security_deposit,
                    "rental_utility_deposit": rental_utility_deposit,
                    "rental_duration": rental_duration,
                    "rental_status": rental_status,
                    "agrement_id": agrement_id
                };
            $.ajax({
                type: "POST",
                url: _url,
                data: jsonObject,
                 xhrFields: {
                    responseType: 'blob' // Important for handling binary data
                },
            success: function(response) {
                    var blob = new Blob([response], { type: 'application/pdf' });
        
                    // Create a temporary URL for the blob
                    var blobUrl = window.URL.createObjectURL(blob);
        
                    // Open the URL in a new tab or window
                    window.open(blobUrl);
        
                    // Remove the temporary URL
                    window.URL.revokeObjectURL(blobUrl);
                }
    });
});
    });
</script>
<!--end date range picker jquer-->
@endpush
<!--$("#rental_status").text(rentalStatusText);-->
<!--var rentalStatusText = response.data.agreement.status == 1 ? 'Active' : 'Inactive';-->

<!--var agent_servic = response.data.agreement.agent_service == 1 ? 'Yes' : 'Inactive';-->
