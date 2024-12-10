@extends('layout.master-without-nav')
@section('title')
    Reset Password
@endsection
@section('page-title')
    Reset Password
@endsection
@section('body')

    <body>
    @endsection
@section('content')
        <div class="authentication-bg min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-lg-6 col-xl-5">

                            <div class="mb-4 pb-2">
                                <a href="#" class="d-block auth-logo">
                                    <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="30"
                                        class="auth-logo-dark me-start">
                                    <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="30"
                                        class="auth-logo-light me-start">
                                </a>
                            </div>

                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                     <h3 class="title"><span>{!! siteName() !!}</span>{{ $title}} </h3>
                                        <p class="text-muted">secure your account with ReatTag.</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <form method="POST" action="{!! route('forget.password-submit') !!}" class="auth-input">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ $email ?? old('email') }}" required
                                                    autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                            <div class="mt-4 text-center">
                                             <button type="submit" class="mb-0 {!! getButtonClass() !!}">RESET PASSWORD</button>

                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div><!-- end col -->
                    </div><!-- end row -->
@endsection
