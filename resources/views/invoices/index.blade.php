@extends('layout.master')

@section('title')
    Invoices
@endsection
<link rel="stylesheet" href="{{ URL::asset('../build/libs/gridjs/theme/mermaid.min.css') }}">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">





<!--@section('css')-->
    
<!--@endsection-->
@section('page-title')
    Invoices
@endsection
@section('body')
    <body>
    @endsection


    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="position-relative">
                            <div class="modal-button mt-2">
                                    <a href="#" class="create-new">
                                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".add-new-order">
                                            <i class="mdi mdi-plus me-1"></i>Create New
                                        </button>
                                    </a>
                            </div>
                        </div>
                        <div id="table-ecommerce-orders"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        </div>
        <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    @php
        $invSetting = App\Models\InvoiceSetting::all()->first();
    @endphp

        <!--  Create Large modal example -->
        <div class="modal fade add-new-order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Create Invoice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>    
                        <div class="modal-body">

                         <form id="frm_create" method="POST" action="{{ route('invoices.create.update') }}"
                            class="cls-crud-simple-save" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden"  name="id">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label for="first_name">Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="startDate" class="form-control" name="name"
                                             required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Identity Number :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="startDate" class="form-control"
                                                name="identity_number"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="first_name">Service Tax :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="service_tax" class="form-control" value="{{$invSetting->service_tax}}"  name="service_tax"
                                               readonly required>
                                        </div>
                                        <p class="text-danger" id="dateError"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="first_name">Invoice Type :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control select-landlord" id="exampleSelect"
                                                name="invoice_type" required>
                                                <option value="">Select Type</option>
                                                <option 
                                                    value="Miscellaneous">Miscellaneous
                                                </option>
                                                <option
                                                    value="Rental Invoice">Rental Invoice
                                                </option>
                                                <option
                                                    value="Deposit">Deposit</option>
                                                <option 
                                                    value="House Maintenance">House Maintenance</option>
                                                <option
                                                    value="Refund">Refund</option>
                                                <option
                                                    value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 " id="dynamic-rows-container">
                                   <div class="row ">
                                        <div class="dynamic-row col-sm-12 d-flex">
                                        <div class="col-sm-3">
                                            <label for="first_name">Item :<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="name" id="endDate" class="form-control" name="items[]" required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="first_name">Description :<span
                                                    class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="endDate" class="form-control"
                                                        name="descriptions[]"   required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="first_name">Amount :<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="endDate" class="form-control"
                                                        name="amounts[]" required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn bg-danger btn-remove-row" style="color: #fff;">-</button>
                                        </div>
                                    </div>
                                    </div>
                                   
                                 
                                </div>

                                <div class="col-sm-12 mb-2 ">
                                    <button type="button" class="btn bg-primary" id="btn-add-row" style="color: #fff;">+</button>
                                </div>
                                <div class="col-sm-12">
                                    <button id="sumit-btn" type="submit"
                                        class="btn btn-success  ">Create </button>
                                </div>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<!-- Edit Modal Start-->
<div class="modal fade edit-order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Invioce</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="frm_edit" method="POST" action="{{ route('invoices.create.update') }}"
                            class="cls-crud-simple-save" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ @$getData->id }}" name="id" id="edit_id" class="edit_id">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label for="first_name">Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="name" class="form-control name" name="name"
                                                value="{{ @$getData->name ?? old('name')  }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Identity Number :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="identity_number" class="form-control identity_number"
                                                name="identity_number"
                                                value="{{ @$getData->identity_number ?? old('identity_number')  }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="first_name">Service Tax :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="service_tax" class="form-control service_tax" name="service_tax"
                                                value="{{ @$getData->service_tax ?? old('service_tax')  }}" readonly required>
                                        </div>
                                        <p class="text-danger" id="dateError"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="first_name">Invoice Type :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control select-landlord invoice_type" id="invoice_type"
                                                name="invoice_type" required>
                                                <option value="">Select Type</option>
                                                <option @if(@$getData->invoice_type == 'Miscellaneous') selected @endif
                                                    <option value="">Select Type</option>
                                                    <option {{ @$getData->invoice_type == 'Miscellaneous' ? 'selected' : '' }} value="Miscellaneous">Miscellaneous</option>
                                                    <option {{ @$getData->invoice_type == 'Rental Invoice' ? 'selected' : '' }} value="Rental Invoice">Rental Invoice</option>
                                                    <option {{ @$getData->invoice_type == 'Deposit' ? 'selected' : '' }} value="Deposit">Deposit</option>
                                                    <option {{ @$getData->invoice_type == 'House Maintenance' ? 'selected' : '' }} value="House Maintenance">House Maintenance</option>
                                                    <option {{ @$getData->invoice_type == 'Refund' ? 'selected' : '' }} value="Refund">Refund</option>
                                                    <option {{ @$getData->invoice_type == 'Others' ? 'selected' : '' }} value="Others">Others</option>
                                             </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 " id="dynamic-rows-container-edit">
                                    <div class="row itemData">
                                       
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-2 ">
                                    <button type="button" class="btn bg-primary" id="btn-add-row-edit" style="color: #fff;">+</button>
                                </div>
                                <div class="col-sm-12">
                                    <button id="sumit-btn" type="submit"
                                        class="btn btn-success ">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

    @endsection
    @section('scripts')
        <script src="{{ URL::asset('/build/libs/gridjs/gridjs.umd.js') }}"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


        <script>
                $(document).ready(function(){
                   
                    new gridjs.Grid({
                        columns: [
                            {
                                name: 'Invoice No',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                             {
                                name: 'Name',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'IC No/Identity No',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'Type',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'Tax',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'Total',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'Action',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: 'Download',
                                sort: {
                                    enabled: false
                                },
                                formatter: (cell) => gridjs.html(`<span class="fw">${cell}</span>`)
                            },
                            {
                                name: "Status",
                                sort: {
                                  enabled: false
                                },
                                formatter: (function (cell) {
                                  return gridjs.html(`<div class="d-flex gap-3">${cell}</div>`);
                                
                                })
                              },
                              
                        ],
                        pagination: {
                            limit: 7
                        },
                        sort: true,
                        search: true,
                         data : [ 
                                    <?php foreach($invoices as $invoice){ ?>
                                    <?php 

                                    $statusButtonGroup = '<div class="btn-group">';

                                    if ($invoice->status == 1) {
                                        $statusButtonGroup .= '<button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Paid</button>';
                                    } elseif ($invoice->status == 2) {
                                        $statusButtonGroup .= '<button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cancelled</button>';
                                    } else {
                                        $statusButtonGroup .= '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Unpaid</button>';
                                    }
                                    
                                    $statusButtonGroup .= '<div class="dropdown-menu"><a class="dropdown-item invoice-status" href="#" data-status="0" data-ins_id="' . $invoice->id . '">Unpaid</a><a class="dropdown-item invoice-status" href="#" data-status="1" data-ins_id="' . $invoice->id . '">Paid</a><a class="dropdown-item invoice-status" href="#" data-status="2" data-ins_id="' . $invoice->id . '">Cancelled</a></div></div>';

                                    $editButton = '';
                                    $deleteButton = '';
                                    if($invoice->status ==0){
                                    $data_litems = htmlspecialchars(json_encode($invoice->item_list), ENT_QUOTES);
                                    $editButton='<button class=" btn deleteButton editButtons"  data-litems="'.$data_litems.'" data-id="' .$invoice->id . '" data-name="' .$invoice->name. '"  data-identity_number="' .$invoice->identity_number. '" data-service_tax="' .$invoice->service_tax. '" data-invoice_type="' .$invoice->invoice_type. '" data-items="' .$invoice->items. '" data-descriptions="' .$invoice->descriptions. '" data-amounts="' .$invoice->amounts. '"><i class="fas fa-edit "></i></a></button>';
                                    $deleteButton='<button class=" btn deleteButton deleteButtons" data-id="' .$invoice->id . '"><i class=" fas fa-trash text-danger  "></i></button>';
                                    }
                                     $dropdownButton = '<div class=""btn-group"><button type="button" class="btn  btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ' . ($invoice->status != 1 ? 'disabled="disabled"' : '') . '><i class="fas fa-file-invoice p-2" style="font-size:10px;"></i></button><div class="dropdown-menu"><a class="dropdown-item " href="' . route('invoices.download.pdf',['id'=>$invoice->id,'type'=>'receipt']) . '">Receipt</a><a class="dropdown-item " href="' . route('invoices.download.pdf',['id'=>$invoice->id,'type'=>'invoice']) . '">Invoice</a></div></div>';                                    
                                    // $btnnnStatus = '<button type="button" class="btn btn-sm ' . ($invoice->status == 1 ? 'btn-success' : ($invoice->status == 2 ? 'btn-danger' : 'btn-primary')) . ' dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . ($invoice->status == 1 ? 'Paid' : ($invoice->status == 2 ? 'Cancelled' : 'Unpaid')) . '</button><div class="dropdown-menu"><a class="dropdown-item invoice-status" href="#" data-status="0" data-id="' . $invoice->id . '">Unpaid</a><a class="dropdown-item invoice-status" href="#" data-status="1" data-id="' . $invoice->id . '">Paid</a><a class="dropdown-item invoice-status" href="#" data-status="2" data-id="' . $invoice->id . '">Cancelled</a></div>';
                                    
                                    ?>
                                        ['<?=$invoice->invoice_number;?>','<?=$invoice->name;?>','<?=$invoice->identity_number;?>','<?=$invoice->invoice_type;?>','<?=$invoice->service_tax;?>','<?=$invoice->total;?>','<?=$editButton . $deleteButton;?>','<?=$dropdownButton;?>','<?=$statusButtonGroup;?>'],<?php } ?>
                                    
                                ]
                    }).render(document.getElementById("table-ecommerce-orders"));
                
                
                })
                
        </script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        

        <script>
      
            $(document).ready(function() {
                $(document).on('click','.invoice-status',function(event) {
                        event.preventDefault();

                    // Get the data attributes of the clicked option
                    var status = $(this).data('status');
                    // alert(status);
                    var id = $(this).data('ins_id');
                    var _url = "{{ route('invoices.change.status')}}";
                     var csrfToken = "{{ csrf_token() }}";

                    $.ajax({
                        url:  _url,
                        method: 'POST',
                        data: {
                               status: status ,
                               id:id,
                              _token: csrfToken

                              },
                        success: function(response) {
                             if (response.success) {
                                showAlert(1, response.success);
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                               
                            } else {
                                showAlert(0, response.error);
                                 setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            }
                            
                        
                        },
                        error: function(error) {
                            
                        }
                    });
                });
         });
             
        //edit invioce
    $(document).on('click', '.editButtons', function() {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var identity_number = $(this).data('identity_number');
    var service_tax = $(this).data('service_tax');
    var invoice_type = $(this).data('invoice_type');
    // The variables `items`, `descriptions`, `amounts` are captured but not used in the snippet provided.
    var litems = $(this).data('litems');
    var targetDiv = $('.itemData');
    var result = litems.substring(1, litems.length - 1);
    $(".edit-order").modal('show');
    
    // Set values to inputs outside the loop
    $('.name').val(name);
    $('.identity_number').val(identity_number);
    $('.service_tax').val(service_tax);
    $('.invoice_type').val(invoice_type);

    // Clear previous contents from the target div to prevent duplication
    targetDiv.empty();

    // Parse JSON and dynamically create invoice item elements
    var jsonArray = JSON.parse(result);
    jsonArray.forEach(function(item) {
        var htmlContent = '<div class="dynamic-row-edit col-sm-12 d-flex"><div class="col-sm-3">' +
                            '<label for="first_name">Item:<span class="text-danger">*</span></label>' +
                            '<div class="form-group">' +
                                '<div class="form-line">' +
                                    '<input type="name" id="items" class="form-control items" name="items[]" value="' + item.items + '" required>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-6">' +
                            '<label for="first_name">Description:<span class="text-danger">*</span></label>' +
                            '<div class="form-group">' +
                                '<div class="form-line">' +
                                    '<input type="text" id="descriptions" class="form-control descriptions" name="descriptions[]" value="' + item.descriptions + '" required>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-2">' +
                            '<label for="first_name">Amount:<span class="text-danger">*</span></label>' +
                            '<div class="form-group">' +
                                '<div class="form-line">' +
                                    '<input type="number" id="amounts" class="form-control amounts" name="amounts[]" value="' + item.amounts + '" required>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-sm-1">' +
                            '<button type="button" class="btn bg-danger btn-remove-row" style="color: #fff;">-</button>' +
                        '</div></div>';
        
        // Append HTML content to target div
        targetDiv.append(htmlContent);
    });

    $('#edit_id').val(id);
});

// Optionally, if there's a need to remove items dynamically
$(document).on('click', '.btn-remove-row', function() {
    $(this).closest('.dynamic-row-edit').remove();
});

        //end edit invioce
                $(document).on('click', '.deleteButtons', function() {    
            // $(".del-btn").click(function() {
                var del_id = $(this).attr("data-id");
                var _url = "{{ route('invoices.delete')}}";
                var csrfToken = "{{ csrf_token() }}";
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You wont be able to revert this!',
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
                                _token: csrfToken,
                                id: del_id,
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('.delete_' + del_id).remove();
                                    $('.message').addClass('text-success').text(
                                        'Action Performed Successfully.');
                                        window.location.reload();
                                } else {
                                    $('.message').addClass('text-danger').text(
                                        'Action Failed!Please try again later.')
                                }
                            }
                        });
                    }
                });
            });
            
//   add and remove row in the create invioce
            $(document).ready(function() {
                // Add row
                $("#btn-add-row").click(function() {
                    var newRow = $(".dynamic-row:last").clone();
                    newRow.find("input").val(""); // Clear input value
                    $(this).parent('div').siblings("#dynamic-rows-container").children('.row').append(newRow);
                });
            
                // Remove row
                $("#dynamic-rows-container").on("click", ".btn-remove-row", function() {
                    $(this).closest(".dynamic-row").remove();
                });
            });
//   add and remove row in the edit invioce
            $(document).ready(function() {
                // Add row
                $("#btn-add-row-edit").click(function() {
                    var newRow = $(".dynamic-row-edit:last").clone();
                    newRow.find("input").val(""); // Clear input value
                    $(this).parent('div').siblings("#dynamic-rows-container-edit").children('.row').append(newRow);
                });
            
                // Remove row
                $("#dynamic-rows-container-edit").on("click", ".btn-remove-row", function() {
                    $(this).closest(".dynamic-row-edit").remove();
                });
            });

        //edit Invioce
        
            //     $(document).on('click', '.editButtons', function(){
            //     $(".edit-order").modal('show');

            // });
            
 
         //delete Tenant Template
                 function showAlert(status, message) {
            Swal.fire({
                icon: status ? 'success' : 'error',
                text: message,
                timer: 1500,  // Set the duration in milliseconds (1 second)
                showConfirmButton: false
            });
        };
        
        
 $(document).ready(function() {
    // General selector to handle both forms
    $('#frm_create, #frm_edit').submit(function(e) {
        e.preventDefault(); 
        var $form = $(this);
        var formAction = $form.attr('action');
        var isCreateForm = $form.attr('id') === 'frm_create';

        $.ajax({
            type: "POST",
            url: formAction,
            data: $form.serialize(),
            success: function(response) {
                // Determine the message based on the form ID
                var message = isCreateForm ? 'Invoice has been created.' : 'Invoice has been updated.';
                showAlert(true, message);
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            },
            error: function(error) {
                // Error message also varies by form
                var errorMessage = isCreateForm ? 'Failed to create Agreement.' : 'Failed to update Agreement.';
                showAlert(false, errorMessage);
                console.error(error);
            }
        });
    });
});
            
            
            
            


        </script>
    @endsection
