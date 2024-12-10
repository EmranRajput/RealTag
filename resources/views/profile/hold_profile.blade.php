@extends('layout.master')
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

.pass {
    border: none;
    background: inherit;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color:#23fd0f;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>
@endpush
@section('content')
<section class="content profile-page">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12 p-l-0 p-r-0">
                <section class="boxs-simple">
                    <!--<div class="profile-header">-->
                    <!--    <div class="profile_info">-->
                    <!--        <div class="profile-image">-->
                    <!--            @if(userLogin()->profile_photo !== null)-->
                    <!--            <img src="{{ userLogin()->getProfilepic(1) }}" alt="{{ userLogin()->name }}"-->
                    <!--                class="profile-img-two" width="120">-->
                    <!--            @else-->
                    <!--            <img src=" {{ asset('assets/images/default.png') }} " alt="{{ userLogin()->name }}"-->
                    <!--                class="profile-img-two">-->
                    <!--            @endif-->
                    <!--        </div>-->
                    <!--        <h4 class="mb-0">{{ logName() }}</h4>-->
                    <!--        <span class="text-muted col-white">{{ logRolePrint() }}</span>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="profile-sub-header"></div>
                </section>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Personal Profile</h2>
                    </div>
                    <div class="body">
                        <form id="frmProfile" method="POST" action="{!! $urlSave !!}" class="cls-crud-simple-save"
                            enctype="multipart/form-data">
                            <div class="row clearfix justify-content-center">
                                <div class="col-mg-12">
                                    <div class="form-group">
                                        <div class="profile-img">
                                            <input type="file" id="file-1" accept="image/*" name="profile_image">
                                            <label for="file-1" id="file-1-preview">
                                                @if(userLogin()->profile_photo !== null)
                                                <img src="{{ userLogin()->getProfilepic(1) }}"
                                                    alt="{{ userLogin()->name }}" class="profile-img-two">
                                                @else
                                                <img src=" {{ asset('assets/images/default.png') }} "
                                                    alt="{{ userLogin()->name }}" class="profile-img-two">
                                                @endif
                                                <div>
                                                    <span>+</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label for="first_name">First Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            @php
                                            $name = explode(" ",userLogin()->name);
                                            $fname = isset($name[0]) ? $name[0] : '';
                                            $lname = isset($name[1]) ? $name[1] : '';
                                            @endphp
                                            <input type="text" class="form-control" placeholder="First Name"
                                                name="first_name" value="{{ $fname }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="last_name">Last Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Last Name"
                                                name="last_name" value="{{ $lname }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label for="last_name">Date of Birth :<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="datepicker" class="datepicker form-control"
                                                placeholder="Date of Birth" name="bitrh_date"
                                                value="{{ frDate(userLogin()->birth_date) }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="last_name">Select Gender:<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <select class="form-control show-tick select2" name="gender">
                                            {!! makeDropdown(siteConfig('gender'),userLogin()->gender) !!}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="last_name">Phone Number :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" placeholder="Phone"
                                                name="phone_number" value="{{ userLogin()->phone_number }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="last_name">Email :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control" placeholder="Enter Your Email"
                                                name="email" value="{{logEmail()}}" required disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>IC Number :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" placeholder="IC Number"
                                                name="ic_number" value="{{ userLogin()->ic_number }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>Address :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Address" name="address"
                                                value="{{ userLogin()->address }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <label for="last_name">Rental Email Reminder :</label>
                                        <div class="form-line d-flex">
                                            <div class="input-group-append">
                                                <label class="switch">
                                                    <input type="checkbox" {{userLogin()->reminder_email_toggle==1 ? 'checked' : ''}} id="reminder_toggle">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <!-- Hidden input field to store the toggle value -->
                                            <input type="hidden" name="reminder" id="reminder_input" value="{{userLogin()->reminder_email_toggle==1 ? '1' : '0'}}">
                                        </div>
                                    </div>
                             </div>
                             <div class="col-sm-6">
                                    <div class="input-group">
                                        <label for="last_name">Birthday Email Reminder :</label>
                                        <div class="form-line d-flex">
                                            <div class="input-group-append">
                                                <label class="switch">
                                                    <input type="checkbox" id="reminder_toggle1" {{userLogin()->birthday_reminder_toggle==1 ? 'checked' : ''}}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <!-- Hidden input field to store the toggle value -->
                                            <input type="hidden" name="reminder_birthday" id="reminder_input1" value="{{userLogin()->birthday_reminder_toggle==1 ? '1' : '0'}}">
                                        </div>
                                    </div>
                             </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-raised g-bg-cyan">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      
        @if(userLogin()->role == '1')
         
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Invoice Setting</h2>
                    </div>
                    
                    <div class="body">
                        <form id="frmPassword" method="POST" action="{{ route('Invoice-setting') }}" class="cls-crud-simple-save" enctype="multipart/form-data">
                            <input name="inv_set_id" value="{{(isset($inv_setting->id)) ? $inv_setting->id : 0}}" type="hidden">
                            <input name="agent_id" value="{{userLogin()->id}}" type="hidden">
                            <div class="input-group">
                                <label for="last_name">Company Name :<span class="text-danger">*</span>
                                </label>
                                <div class="form-line d-flex">
                                    <input type="text" id="password" class="form-control"  value="{{(isset($inv_setting->company_name)) ? $inv_setting->company_name : ''}}" name="company_name"
                                        placeholder="Enter Company Name" required>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="logo">Company Logo: <span class="text-danger">*</span></label>
                                <div class="form-line d-flex">
                                    <input type="file" id="logo" class="form-control"  name="logo" accept="image/*" >
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="last_name">Company Address :<span class="text-danger">*</span></label>
                                <div class="form-line d-flex">
                                    <input type="text" id="password" value="{{(isset($inv_setting->company_address)) ? $inv_setting->company_address : ''}}" class="form-control" name="company_address"
                                        placeholder="Enter Address" required>
                                </div>
                                <label for="last_name">Company Tel Number :<span class="text-danger">*</span></label>
                                <div class="form-line d-flex">
                                    <input type="number" id="password" class="form-control" value="{{(isset($inv_setting->contact)) ? $inv_setting->contact : ''}}" name="contact"
                                        placeholder="Enter Contact No." required>
                                </div>
                                 <div class="input-group">
                                <label for="last_name">Company Fax Number :<span class="text-danger">*</span>
                                </label>
                                <div class="form-line d-flex">
                                    <input type="text" value="{{(isset($inv_setting->company_fax)) ? $inv_setting->company_fax : ''}}" id="password" class="form-control" name="company_fax"
                                        placeholder="Enter Comapany Fax" required>
                                </div>
                                 <div class="input-group">
                                <label for="last_name">SST ID :<span class="text-danger">*</span>
                                </label>
                                <div class="form-line d-flex">
                                    <input type="number" value="{{(isset($inv_setting->sst_id)) ? $inv_setting->sst_id : ''}}" id="password" class="form-control" name="sst_id"
                                        placeholder="Enter SST_ID" required>
                                </div>
                                 <div class="input-group">
                                    <label for="last_name">Footer Description :<span class="text-danger">*</span></label>
                                    <div class="form-line d-flex">
                                        <input type="text" value="{{(isset($inv_setting->description)) ? $inv_setting->description : ''}}" id="password" class="form-control" name="description"
                                            placeholder="Enter Description" required>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-12">
                                        <button type="submit" class="btn btn-raised g-bg-cyan">Submit</button>
                                    </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Security</h2>
                    </div>
                    <div class="body">
                        <form id="frmPassword" method="POST" action="{!! $paswordChange !!}"
                            class="cls-crud-simple-save">
                            <div class="input-group">
                                <label for="last_name">Password :<span class="text-danger">*</span>
                                </label>
                                <div class="form-line d-flex">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Password" required>
                                    <div class="input-group-append">
                                        <button class="pass " type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Confirm Password :<span class="text-danger">*</span></label>
                                <div class="form-line d-flex">
                                    <input type="password" id="confirm_password" class="form-control"
                                        name="confirm_password" placeholder="Confirm Password" required>
                                    <div class="input-group-append">
                                        <button class="pass " type="button" id="confirm_togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-raised g-bg-cyan">Submit</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the checkbox and hidden input elements
        var toggleCheckbox = document.getElementById('reminder_toggle');
        var reminderInput = document.getElementById('reminder_input');

        // Add an event listener to the checkbox for changes
        toggleCheckbox.addEventListener('change', function () {
            // Update the value of the hidden input based on the checkbox state
            reminderInput.value = toggleCheckbox.checked ? 1 : 0;
        });
        var toggleCheckbox1 = document.getElementById('reminder_toggle1');
        var reminderInput1 = document.getElementById('reminder_input1');

        // Add an event listener to the checkbox for changes
        toggleCheckbox1.addEventListener('change', function () {
            // Update the value of the hidden input based on the checkbox state
            reminderInput1.value = toggleCheckbox1.checked ? 1 : 0;
        });
    });

previewBeforeUpload("file-1");

const passwordField = document.getElementById("password");
const toggleButton = document.getElementById("togglePassword");

toggleButton.addEventListener("click", function() {
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
});



const c_passwordField = document.getElementById("confirm_password");
const c_toggleButton = document.getElementById("confirm_togglePassword");

c_toggleButton.addEventListener("click", function() {
    if (c_passwordField.type === "password") {
        c_passwordField.type = "text";
    } else {
        c_passwordField.type = "password";
    }
});



</script>
@endpush