@extends('layout.master')
@section('title')
    Add Agent
@endsection
@section('css')

@endsection
@section('page-title')
    Add Agent
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                         <h2>{!! $title !!}</h2>
                        <small class="text-muted">{!! env('APP_NAME') !!}</small>
                    </div>
                    <div class="card-body">
                        <form action="{!! route('agent.save') !!}" method="post" class="cls-crud-simple-save"
                            enctype="multipart/form-data">
                            @csrf
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                     @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
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
                                            <input type="date" id="datepicker" class="datepicker form-control"
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
                                <div class="col-md-6 col-sm-12 mt-3">
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
                                <div class="col-sm-12 col-md-12 mt-3">
                                    <label>Address :<span class="text-danger">*</span></label>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea class="form-control no-resize" placeholder="Address"
                                                name="address" required>{!! old('address') ?? $single->address !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <button type="submit" class="btn btn-success g-bg-cyan">Submit</button>
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </div>
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

    @endsection

