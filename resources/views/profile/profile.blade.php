@extends('layout.master')
@section('title')
    Personal Profile
@endsection
@section('css')
    <!-- choices css -->
    <link href="{{ URL::asset('build/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- color picker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/@simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/@simonwep/pickr/themes/monolith.min.css') }}" /> <!-- 'monolith' theme -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/@simonwep/pickr/themes/nano.min.css') }}" /> <!-- 'nano' theme -->

    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
    
@endsection
@section('page-title')
    Personal Profile
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-body">
                    <h5 class="white-space-no-wrap">{!! logName() !!}</h5>
                        <form id="frmProfile" method="POST" action="{!! $urlSave !!}" class="cls-crud-simple-save"
                            enctype="multipart/form-data">
                              @csrf
                            <div class=" row justify-content-center align-items-center">
                                <div class="col-sm-6 text-center">
                                    <div class="form-group">
                                        <div class="profile-img ">
                                            <!--<input type="file" id="file-1" accept="image/*" class="mt-2" name="profile_image">-->
                                            <label for="file-1" id="file-1-preview">
                                                @if(userLogin()->profile_photo !== null)
                                                <img src="{{ userLogin()->getProfilepic(1) }}"
                                                    alt="{{ userLogin()->name }}" class="profile-img-two" style="width: 200px; height: 200px; border-radius:50%; margin-top:50%; border: 2px solid #fff;">
                                                @else
                                                <img src=" {{ asset('assets/images/default.png') }} "
                                                    alt="{{ userLogin()->name }}" class="profile-img-two" style="width: 200px; height: 200px; border-radius:50%; margin-top:50%; margin-left:100%; border: 2px solid #fff;">
                                                @endif
                                                
                                                <div>
                                                <span style="font-size:2rem; display:block; display:flex; align-items:center; justify-content:center; height:3rem; border-radius:50%;  width:3rem; margin:0 auto; margin-top:-1rem; color:#ccc; border:1px solid #ccc;  background-color:white;">+</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                    <input type="file" id="file-1" accept="image/*" class="mt-2" name="profile_image">                  
                                    </div>
                                    </div>
                                </div>
                            <div class="row clearfix">
                                <div class="col-sm-6 mt-3">
                            <!--<form id="frmProfile" method="POST" action="{!! $urlSave !!}" class="cls-crud-simple-save"-->
                            <!--enctype="multipart/form-data">-->
                            <!--  @csrf-->
                                    <label for="first_name">First Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            @php
                                            $name = explode(" ",userLogin()->name);
                                            $fname = isset($name[0]) ? $name[0] : '';
                                            $lname = isset($name[1]) ? $name[1] : '';
                                            @endphp
                                            <input type="text" class="form-control" id="fname" placeholder="First Name"
                                                name="first_name" value="{{ $fname }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="last_name">Last Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="lname" placeholder="Last Name"
                                                name="last_name" value="{{ $lname }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6 mt-3">
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
                                <div class="col-sm-6  mt-3">
                                    <label for="last_name">Select Gender:<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <select class="form-control show-tick select2" name="gender">
                                            {!! makeDropdown(siteConfig('gender'),userLogin()->gender) !!}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6  mt-3">
                                    <label for="last_name">Phone Number :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" placeholder="Phone"
                                                name="phone_number" value="{{ userLogin()->phone_number }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6  mt-3">
                                    <label for="last_name">Email :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control" placeholder="Enter Your Email"
                                                name="email" value="{{logEmail()}}" required disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6  mt-3">
                                    <label>IC Number :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" placeholder="IC Number"
                                                name="ic_number" value="{{ userLogin()->ic_number }}"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6  mt-3">
                                    <label>Address :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Address" name="address"
                                                value="{{ userLogin()->address }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <div class="input-group">
                                        <label for="last_name">Rental Email Reminder :</label>
                                        <div class="form-line d-flex">
                                            <div class="input-group-append">
                                                <!--<label class="switch" data-on-label="on" data-off-label="off">-->
                                                <!--    <input type="checkbox" {{userLogin()->reminder_email_toggle==1 ? 'checked' : ''}} id="reminder_toggle">-->
                                                <!--    <span class="slider round"></span>-->
                                                <!--</label>-->

                                            <input type="checkbox" class="switch-active" {{userLogin()->reminder_email_toggle==1 ? 'checked' : ''}} id="reminder_toggle"   switch="none"  />
                                            <label for="reminder_toggle"  data-on-label="on" data-off-label="off"></label>
<!--//-->
                                            </div>


                                    <!--<input type="checkbox" class="switch-active" id="switch1" data-id="" value="" switch="none"  />-->
                                    <!--<label for="switch1  data-on-label="on" data-off-label="off"></label>-->
                                    <!--//-->
                                            <!-- Hidden input field to store the toggle value -->
                                            <input type="hidden" name="reminder" id="reminder_input" value="{{userLogin()->reminder_email_toggle==1 ? '1' : '0'}}">
                                        </div>
                                    </div>
                             </div>
                             <div class="col-sm-6 mt-3 ml-3">
                                    <div class="input-group">
                                        <label for="last_name">Birthday Email Reminder :</label>
                                        <div class="form-line d-flex">
                                            <div class="input-group-append">
                                                <!--<label class="switch">-->
                                                <!--    <input type="checkbox" id="reminder_toggle1" {{userLogin()->birthday_reminder_toggle==1 ? 'checked' : ''}}>-->
                                                <!--    <span class="slider round"></span>-->
                                                <!--</label>-->
                                            <input type="checkbox" class="switch-active" {{userLogin()->birthday_reminder_toggle==1 ? 'checked' : ''}} id="reminder_toggle1"   switch="none"  />
                                            <label for="reminder_toggle1"  data-on-label="on" data-off-label="off"></label>
                                            </div>
                                            <!-- Hidden input field to store the toggle value -->
                                            <input type="hidden" name="reminder_birthday" id="reminder_input1" value="{{userLogin()->birthday_reminder_toggle==1 ? '1' : '0'}}">
                                        </div>
                                    </div>
                             </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success g-bg-cyan">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      
        @if(userLogin()->role == '1')
         
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Invoice Setting</h4>
                    </div>
                    <div class="card-body">
                        <form id="frmPassword1" method="POST" action="{{ route('Invoice-setting') }}" class="cls-crud-simple-save" enctype="multipart/form-data">
                            @csrf
                            <input name="inv_set_id" value="{{(isset($inv_setting->id)) ? $inv_setting->id : 0}}" type="hidden">
                            <input name="agent_id" value="{{userLogin()->id}}" type="hidden">
                            <!--//-->
                             <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label for="first_name">Company Name :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" id="company_name" class="form-control"  value="{{(isset($inv_setting->company_name)) ? $inv_setting->company_name : ''}}" name="company_name"
                                        placeholder="Enter Company Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="last_name">Company Logo :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="logo" class="form-control"  name="logo" accept="image/*" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6 mt-3">
                                    <label for="last_name">Company Address :<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                             <input type="text" id="company_address" value="{{(isset($inv_setting->company_address)) ? $inv_setting->company_address : ''}}" class="form-control" name="company_address"
                                        placeholder="Enter Address" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="last_name">Company Tel Number:<span class="text-danger">*</span></label>
                                    <div class="form-line d-flex">
                                    <input type="number" id="Company_tel" class="form-control" value="{{(isset($inv_setting->contact)) ? $inv_setting->contact : ''}}" name="contact"
                                        placeholder="Enter Contact No." required>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="last_name">Company Fax Number :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                             <input type="text" value="{{(isset($inv_setting->company_fax)) ? $inv_setting->company_fax : ''}}" id="Company_fax" class="form-control" name="company_fax"
                                        placeholder="Enter Comapany Fax" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="last_name">SST ID  :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" value="{{(isset($inv_setting->sst_id)) ? $inv_setting->sst_id : ''}}" id="sst" class="form-control" name="sst_id"
                                                placeholder="Enter SST_ID" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label>Service Tax  :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" value="{{(isset($inv_setting->service_tax)) ? $inv_setting->service_tax : ''}}" id="service_tax" class="form-control" step="0.01" name="service_tax"
                                            placeholder="Enter service_tax" required style="font-size: 16px; height: 40px;">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-6 mt-3">
                                    <label>Footer Description  :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" value="{{(isset($inv_setting->description)) ? $inv_setting->description : ''}}" id="description" class="form-control" name="description"
                                            placeholder="Enter Description" required style="font-size: 16px; height: 40px;">
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-sm-12 mt-3">
                                    <button type="submit" class="btn btn-success g-bg-cyan">Submit</button>
                                    </div>
                                
                            <!--//-->
                            
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Security</h4>
                    </div>
                    <div class="card-body">
                        <form id="frmPassword" method="POST" action="{!! $paswordChange !!}" 
                            class="cls-crud-simple-save">
                            @csrf
                            <div class="col-sm-6">
                                    <label for="last_name">Password  :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                <div class="form-line d-flex">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
                                    <div class="input-group-append">
                                        <button class="pass btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-3">
                                    <label for="last_name">Confirm Password  :<span class="text-danger">*</span></label>
                                    <div class="form-line d-flex align-items-center">
                                    <input type="password" id="confirm_password" class="form-control" name="confirm_password"
                                           placeholder="Confirm Password" required>
                                    <div class="input-group-append">
                                        <button class="pass btn btn-outline-secondary" type="button" id="confirm_togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                </div>
                           <!-- <div class="input-group">-->
                           <!--     <label for="last_name">Password :<span class="text-danger">*</span>-->
                           <!--     </label>-->
                           <!--     <div class="form-line d-flex">-->
                           <!--         <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>-->
                           <!--         <div class="input-group-append">-->
                           <!--             <button class="pass " type="button" id="togglePassword">-->
                           <!--                 <i class="fas fa-eye"></i>-->
                           <!--             </button>-->
                           <!--         </div>-->
                           <!--     </div>-->
                           <!-- </div>-->
                           <!--<div class="input-group">-->
                           <!--     <label class="mr-2">Confirm Password:<span class="text-danger">*</span></label>-->
                           <!--     <div class="form-line d-flex align-items-center">-->
                           <!--         <input type="password" id="confirm_password" class="form-control" name="confirm_password"-->
                           <!--                placeholder="Confirm Password" required>-->
                           <!--         <div class="input-group-append">-->
                           <!--             <button class="pass btn btn-outline-secondary" type="button" id="confirm_togglePassword">-->
                           <!--                 <i class="fas fa-eye"></i>-->
                           <!--             </button>-->
                           <!--         </div>-->
                           <!--     </div>-->
                           <!-- </div>-->

                            <div class="col-sm-12 mt-3">
                                    <button type="submit" class="btn btn-success g-bg-cyan">Submit</button>
                            </div>
                        </form>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')

<script>
            document.getElementById('file-1').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.querySelector('.profile-img-two'); 
                output.src = reader.result;
                document.getElementById('file-1').style.display = 'none';
                

            };
            
            reader.readAsDataURL(event.target.files[0]);
            
        });
         var output = document.querySelector('.profile-img-two'); 
            if(output.src){
                document.getElementById('file-1').style.display = 'none';

                }

// $(document).ready(function() {
//     $('#file-1').change(function(e) {
//         var fileData = e.target.files[0]; // Get the file
        
//         // Display the selected image
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             $('.profile-img-two').attr('src', e.target.result);
//         };
//         reader.readAsDataURL(fileData);
//         var formData = new FormData(); 
//         formData.append('image', fileData); // Append the file to the FormData object
//         formData.append('name', $('#fname').val() + '.' + $('#lname').val());
//         formData.append('birth_date', $('#datepicker').val()); // Ensure this matches the input's ID for date of birth
//         formData.append('gender', $('[name="gender"]').val()); // Assuming the select name for gender is correct
//         formData.append('phone_number', $('[name="phone_number"]').val());
//         formData.append('email', $('[name="email"]').val()); // Assuming the email input has the name attribute "email"
//         // The email field is marked as disabled, which means it won't be included in the FormData.
//         // If you need to include it, consider removing 'disabled' attribute or manually appending its value if known.
//         formData.append('ic_number', $('[name="ic_number"]').val());
//         formData.append('address', $('[name="address"]').val());

//         // Send the file and data to the server using AJAX
//         $.ajax({
//             url:  $urlSave, // Update with your server-side script URL
//             type: 'POST',
//             data: formData,
//             processData: false, // Tell jQuery not to process the data
//             contentType: false, // Tell jQuery not to set contentType
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token from meta tag
//             },
//             success: function(data) {
//                 console.log(data); // Handle success
//                 alert('Image and details uploaded successfully.');
//             },
//             error: function(xhr, status, error) {
//                 console.error(error); // Handle error
//                 alert('Error uploading details.');
//             }
//         });
//     });
// });








//
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

// previewBeforeUpload("file-1");

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
    @endsection

