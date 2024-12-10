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
</style>
@endpush
@section('content')
<section class="content profile-page">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2> {{ @$getData ? 'Edit': 'Create' }} Rental Agreement</h2>
                    </div>
                    <div class="body">
                        <form id="frm" method="POST" action="{{ route('agent.rental.agreement.create.update') }}"
                            class="cls-crud-simple-save" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ @$getData->id }}" name="id">
                            <div class="row clearfix">
                                <div class="col-sm-6 ">
                                    <label for="first_name">Tenant IC No:<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control select-tenant" id="exampleSelect" name="tenant">
                                                <option value="">Select Tenant</option>
                                                @foreach($tanents as $tanent)
                                                <option value="{{ $tanent->id }}" @if(@$getData->tenant_id ==
                                                    $tanent->id) selected @endif>{{  $tanent->identity_number }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 ">
                                    <label for="first_name">Landlord IC no:<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control select-landlord" id="exampleSelect"
                                                name="landlord">
                                                <option value="">Select Landlord</option>
                                                @foreach($landlords as $landlord)
                                                <option value="{{ $landlord->id }}" @if(@$getData->landlord_id ==
                                                    @$landlord->id) selected @endif>{{  $landlord->identity_number }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Start Date :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" id="startDate" class="form-control" name="start_date"
                                                value="{{ @$getData->start_date ?? old('start_date')  }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">End Date :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" id="endDate" class="form-control" name="end_date"
                                                value="{{ @$getData->end_date ?? old('end_date')  }}" required>
                                        </div>
                                        <p class="text-danger" id="dateError"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Duration :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" min="1" class="form-control input_duration"
                                                name="duration" value="{{ @$getData->duration ?? old('duration')  }}"
                                                disabled>
                                        </div>
                                        <p class="text-danger" id="duration_error"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Rental Amount :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="rental_amount form-control" name="rental_amount"
                                                value="{{ @$getData->rental_amount ?? old('rental_amount')  }}"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="first_name">Security Deposit :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="security_deposit form-control"
                                                name="security_deposit"
                                                value="{{ @$getData->security_deposit ?? old('security_deposit')  }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Utility Deposit :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="utility_deposit form-control"
                                                name="utility_deposit"
                                                value="{{ @$getData->utility_deposit ?? old('utility_deposit')  }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="first_name">Address :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="address"
                                                value="{{ @$getData->address ?? old('address')  }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 ">
                                    <label for="first_name">Agreement:<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="exampleSelect" name="agreement">
                                                <option value="">Select Agreement</option>

                                                @foreach($agreements as $agreement)
                                                <option value="{{ $agreement->id }}" @if(@$getData->agreement_id ==
                                                    @$agreement->id) selected @endif>{{  @$agreement->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="first_name">Agent Services :<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="">
                                                    <input type="checkbox" name="agent_service" value="1" data-toggle="toggle" data-size="sm"
                                                        @if(@$getData->agent_service == 1) checked @endif checked>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($getData == null)
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="first_name">Guest Tenant :<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="">
                                                    <input type="checkbox" class="guest-tenant" data-toggle="toggle"
                                                        data-size="sm" name="guest_tenant" value="yes">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="first_name">Guest Landlord :<span
                                                    class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="">
                                                    <input type="checkbox" class="guest-landlord" data-toggle="toggle"
                                                        data-size="sm" name="guest_landlord" value="yes">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 create-guest-tenant d-none">
                                    <label for="first_name">Tenant Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="tenant_name"
                                                value="{{ old('tenant_name')  }}">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-6 create-guest-tenant d-none">
                                    <label for="first_name">Tenant Email. :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="tenant_email"
                                                value="{{ old('tenant_email')  }}">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 create-guest-tenant d-none">
                                    <label for="first_name">Tenant IC NO. :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="tenant_ic_number"
                                                value="{{ old('tenant_ic_number')  }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 create-guest-landlord d-none">
                                    <label for="first_name">Landlord Email. :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control" name="landlord_email"
                                                value="{{ old('landlord_email')  }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 create-guest-landlord d-none">
                                    <label for="first_name">Landlord Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="landlord_name"
                                                value="{{  old('landlord_name')  }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 create-guest-landlord d-none">
                                    <label for="first_name">Landlord IC NO. :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="landlord_ic_number"
                                                value="{{ old('landlord_ic_number')  }}">
                                        </div>
                                    </div>
                                </div>
                                @endif
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


    $('.guest-tenant').bootstrapToggle();
    $('.guest-landlord').bootstrapToggle();
    $('.guest-tenant').change(function() {
        if ($(this).prop('checked')) {

            $('.create-guest-tenant').removeClass('d-none');
            $('.select-tenant').prop('disabled', true);
        } else {
            $('.create-guest-tenant').addClass('d-none');
            $('.select-tenant').prop('disabled', false);

        }
    });

    $('.guest-landlord').change(function() {
        if ($(this).prop('checked')) {
            $('.create-guest-landlord').removeClass('d-none');
            $('.select-landlord').prop('disabled', true);

        } else {
            $('.create-guest-landlord').addClass('d-none');
            $('.select-landlord').prop('disabled', false);

        }
    });

    $('#startDate, #endDate').on('change', function() {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        if (startDate && endDate) {
            if (startDate > endDate) {
                $('#sumit-btn').prop('disabled', true);
                $('#dateError').text('End Date must be greater than Start Date');
            } else {
                $('#sumit-btn').prop('disabled', false);
                $('#dateError').text('');
            }
        }
    });

$('#endDate').on('change', function() {
    var startDate = moment($('#startDate').val());
    var endDate = moment($('#endDate').val());

    if (startDate.isValid() && endDate.isValid()) {
        var durationInMonths = endDate.diff(startDate, 'months');
        var final;

        if (durationInMonths > 11) {
            var years = Math.floor(durationInMonths / 12);
            var months = durationInMonths % 12;
            final = months + ' Months, ' + years + ' Years';
        } else {
            final = durationInMonths + ' Months';
        }

        console.log(final, 'durationInMonths');

        if (final) {
            $('.input_duration').val(final);
            $('#duration_error').text('');
        } else {
            $('.input_duration').val('');
            $('#duration_error').text('Please enter valid start and end dates.');
        }
    } else {
        $('#duration_error').text('Please enter valid start and end dates.');
    }
});




    $('.rental_amount').on('input', function() {
        var inputValue = $(this).val();
        if (!isNaN(inputValue) && inputValue !== "") {
            var doubledValue = inputValue * 2;
            var halfValue = inputValue * .5;
            $('.security_deposit').val(doubledValue);
            $('.utility_deposit').val(halfValue);
        } else {
            $('.security_deposit').val('');
            $('.utility_deposit').val('');
        }
    });
});
CKEDITOR.replace("ckplot");
// CKEDITOR.instances["ckplot"].setData("<h1> data to render</h1>")
previewBeforeUpload("file-1");
</script>
@endpush