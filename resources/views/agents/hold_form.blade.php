@extends('layout.master')
@section('content')
<style>
#leftsidebar,
.clearHeader,
#morphsearch {
    display: none;
}

.custom-margin {
    margin: 35px 50px 60px 50px !important;
}

@media only screen and (max-width: 700px) {
    .custom-margin {
        margin: 35px 6px 60px 50px !important;
    }
}
</style>
<section class="content custom-margin">
    <div class="container-fluid">
        <div class="block-header">
            <h2>{!! $title !!}</h2>
            <small class="text-muted">{!! env('APP_NAME') !!}</small>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="body">
                        <form action="{!! route('agent.save') !!}" method="post" class="cls-crud-simple-save"
                            enctype="multipart/form-data">
                            @csrf
                            @php
                            $email = request()->has('token') ? $inviteData['email'] : $single->email;
                            $role = request()->has('token') ? $inviteData['role'] :\App\Models\User::ROLE_AGENT;
                            $name = explode(" ",$single->name);
                            $fname = isset($name[0]) ? $name[0] : '';
                            $lname = isset($name[1]) ? $name[1] : '';
                            @endphp
                            <input type="hidden" name="role" value="{!! $role !!}">
                            <input type="hidden" name="id" value="{!! $single->id ? $single->id : 0 !!}">
                            <div class="row clearfix">
                                <div class="col-sm-6 ">
                                    <label for="first_name">First Name :<span class="text-danger">*</span></label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="First Name"
                                                name="first_name" value="{{ old('first_name') ?? $fname }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 ">
                                    <label for="first_name">Last Name :<span class="text-danger">*</span></label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Last Name"
                                                name="last_name" value="{{ old('first_name') ?? $lname }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <label for="last_name">Date of Birth :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="datepicker" class="datepicker form-control"
                                                placeholder="Date of Birth" name="birth_date"
                                                value="{!!  old('birth_date') ?? frDate($single->birth_date) !!}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name">Select Gender:<span class="text-danger">*</span></label>
                                    <div class="form-group drop-custum">
                                        <select class="form-control show-tick select2" name="gender" required>
                                            <option value="">-- Gender --</option>
                                            {!! makeDropDown(siteConfig('gender'),$single->gender) !!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-12">
                                    <label for="last_name">Email :<span class="text-danger">*</span></label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="email" class="form-control" placeholder="Enter Your Email"
                                                name="email" value="{!! $email !!}"
                                                <?php echo $email !=null ? "readonly":'' ?> required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="last_name">Phone Number :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" placeholder="Phone"
                                                name="phone_number"
                                                value="{!!  old('phone_number') ?? $single->phone_number !!}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label>Password :<span class="text-danger">*</span></label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label>Confirm Password :<span class="text-danger">*</span></label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" class="form-control" name="confirm_password"
                                                placeholder="Confirm Password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label>Profile Phote :</label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control" title="Select Profile Picture"
                                                name="profile_photo">
                                            @if($single->profile_photo)
                                            <img src="{{ $single->getPicture(1) }}" alt="{!! $single->name !!}"
                                                width="50" height="50">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label>IC Number :<span class="text-danger">*</span></label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="identity_number"
                                                placeholder="IC Number" id="numberInput"
                                                value="{{ old('identity_number')}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <label>Address :<span class="text-danger">*</span></label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea class="form-control no-resize" placeholder="Address"
                                                name="address" required>{!! old('address') ?? $single->address !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-raised g-bg-cyan">Submit</button>
                                    <button type="submit" class="btn btn-raised">Cancel</button>
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

<script type="text/javascript">
$(function() {

});
</script>
@endpush