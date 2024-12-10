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

.border-dark {
    border: 1px solid black;
}

.profile-img div span {
    font-size: 40px;
}

.text-end {
    text-align: end;
}

.bg-danger {
    background-color: #ff5555;
    /* Use a red color or any color you prefer */
    /* You can also add additional styling like padding, text color, etc. */
    color: #fff;
    /* Set text color to white for better contrast */
    padding: 10px;
    border-radius: 5px;
    /* Optional: Add rounded corners for a softer look */
}

.bg-primary {
    background-color: #007bff;
    /* Use a red color or any color you prefer */
    /* You can also add additional styling like padding, text color, etc. */
    color: #fff;
    /* Set text color to white for better contrast */
    padding: 10px;
    border-radius: 5px;
    /* Optional: Add rounded corners for a softer look */
}
</style>
@endpush
@section('content')
<section class="content profile-page">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2> {{ @$getData ? 'Edit': 'Create' }} Invoices</h2>
                    </div>
                    <div class="body">
                        <form id="frm" method="POST" action="{{ route('invoices.create.update') }}"
                            class="cls-crud-simple-save" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ @$getData->id }}" name="id">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label for="first_name">Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="startDate" class="form-control" name="name"
                                                value="{{ @$getData->name ?? old('name')  }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Identity Number :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="startDate" class="form-control"
                                                name="identity_number"
                                                value="{{ @$getData->identity_number ?? old('identity_number')  }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Service Tax :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="endDate" class="form-control" name="service_tax"
                                                value="{{ @$getData->service_tax ?? old('service_tax')  }}" required>
                                        </div>
                                        <p class="text-danger" id="dateError"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Invoice Type :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control select-landlord" id="exampleSelect"
                                                name="invoice_type" required>
                                                <option value="">Select Type</option>
                                                <option @if(@$getData->invoice_type == 'Miscellaneous') selected @endif
                                                    value="Miscellaneous">Miscellaneous
                                                </option>
                                                <option @if(@$getData->invoice_type == 'Rental Invoice') selected @endif
                                                    value="Rental Invoice">Rental Invoice
                                                </option>
                                                <option @if(@$getData->invoice_type == 'Deposit') selected @endif
                                                    value="Deposit">Deposit</option>
                                                <option @if(@$getData->invoice_type == 'House Maintenance') selected
                                                    @endif
                                                    value="House Maintenance">House Maintenance</option>
                                                <option @if(@$getData->invoice_type == 'Refund') selected @endif
                                                    value="Refund">Refund</option>
                                                <option @if(@$getData->invoice_type == 'Others') selected @endif
                                                    value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 " id="dynamic-rows-container">
                                    @if(count($item_lists) > 0)
                                    @foreach($item_lists as $list)
                                    <div class="dynamic-row col-sm-12 d-flex">
                                        <div class="col-sm-3">
                                            <label for="first_name">Item :<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="name" id="endDate" class="form-control" name="items[]"
                                                        value="{{ @$list->items ?? old('items')  }}" required>
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
                                                        name="descriptions[]"
                                                        value="{{ @$list->descriptions ?? old('descriptions')  }}"
                                                        required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="first_name">Amount :<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="endDate" class="form-control"
                                                        name="amounts[]"
                                                        value="{{ @$list->amounts ?? old('amounts')  }}" required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn bg-danger btn-remove-row">-</button>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="dynamic-row col-sm-12 d-flex">
                                        <div class="col-sm-3">
                                            <label for="first_name">Item :<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="name" id="endDate" class="form-control" name="items[]"
                                                        value="{{ @$list->items ?? old('items')  }}" required>
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
                                                        name="descriptions[]"
                                                        value="{{ @$list->descriptions ?? old('descriptions')  }}"
                                                        required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="first_name">Amount :<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="endDate" class="form-control"
                                                        name="amounts[]"
                                                        value="{{ @$list->amounts ?? old('amounts')  }}" required>
                                                </div>
                                                <p class="text-danger" id="dateError"></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn bg-danger btn-remove-row">-</button>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="col-sm-12 mb-2 ">
                                    <button type="button" class="btn bg-primary" id="btn-add-row">+</button>
                                </div>
                                <div class="col-sm-12">
                                    <button id="sumit-btn" type="submit"
                                        class="btn {{  @$getData ? 'btn-primary' : 'g-bg-cyan'}}  ">
                                        {{  @$getData ? 'Update' : 'Create'}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
$(document).ready(function() {
    // Add row
    $("#btn-add-row").click(function() {
        var newRow = $(".dynamic-row:last").clone();
        newRow.find("input").val(""); // Clear input value
        $("#dynamic-rows-container").append(newRow);
    });

    // Remove row
    $("#dynamic-rows-container").on("click", ".btn-remove-row", function() {
        $(this).closest(".dynamic-row").remove();
    });
});
// CKEDITOR.replace("ckplot");
// CKEDITOR.instances["ckplot"].setData("<h1> data to render</h1>")
// previewBeforeUpload("file-1");
</script>
@endpush