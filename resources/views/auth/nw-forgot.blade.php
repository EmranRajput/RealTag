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
                                <a href="index" class="d-block auth-logo">
                                    <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="30"
                                        class="auth-logo-dark me-start">
                                    <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="30"
                                        class="auth-logo-light me-start">
                                </a>
                            </div>

                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <h5>Reset Password</h5>
                                        <p class="text-muted">Reset Password with {!! siteName() !!}.</p>
                                    </div>
                                    <div class="p-2 mt-4">

                                        <div class="alert alert-success text-center small mb-4" role="alert">
                                            Enter your Email and instructions will be sent to you!
                                        </div>

                                        @if (session('status'))
                                            <div class="alert alert-success mt-4 pt-2 alert-dismissible" role="alert">
                                                {{ session('status') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <form method="POST" action="{!! route('forget.password-submit') !!}" class="auth-input">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ $email ?? old('email') }}" required
                                                    autocomplete="email" autofocus placeholder="Enter Email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100 {!! getButtonClass() !!}" type="submit">Reset</button>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Remember It ? <a href="{{ route('app.login') }}"
                                                        class="fw-medium text-primary"> Sign in </a></p>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div><!-- end col -->
                    </div><!-- end row -->
@endsection