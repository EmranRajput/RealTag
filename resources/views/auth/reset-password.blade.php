@extends('layout.auth')
@section('content')
<div class="container">
    {{-- <div class="card-top"></div> --}}
    <div class="card">
        <h1 class="title"><span>{!! siteName() !!}</span>Reset Password <span class="msg">Reset your password to Use application</span></h1>
        <div class="body">
            <form id="frm" method="post" class="cls-form-validate" action="{!! route('reset.password.submit-form') !!}" >
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-group icon before_span">
                    <span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="email" placeholder="Email" required value="{{ old('email') }}" autofocus>
                    </div>
                </div>
                <div class="input-group icon before_span">
                    <span class="input-group-addon"> <i class="zmdi zmdi-lock"></i> </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" required>
                    </div>
                    <span class="input-group-addon" style="left: 19.5em"> <i class="fas fa-eye-slash" id="togglePassword"></i></span>
                </div>
                <div class="input-group icon before_span">
                    <span class="input-group-addon"> <i class="zmdi zmdi-lock"></i> </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" id="toggleConfirmPassword" placeholder="Confirm Password" value="" required>
                    </div>
                    <span class="input-group-addon" style="left: 19.5em"> <i class="fas fa-eye-slash" id="toggleConfirmPassword"></i></span>
                    <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                </div>
                <div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-raised waves-effect {!! getButtonClass() !!}"> Reset Password</button>
                    </div>
                    <div class="text-center mt-3"> <a class="font-underline col-cyan" href="{{route('app.login')}}">Back to Login</a></div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@push('script')
<script>
    applyTogglePassword("togglePassword","password")
    applyTogglePassword("toggleConfirmPassword","password_confirmation")
    $(document).ready(function () {
   $("#password_confirmation").on('keyup', function(){
        var password = $("#password").val();
        var confirmPassword = $("#password_confirmation").val();
        if (password == confirmPassword){

            $("#CheckPasswordMatch").html("Password match !").removeClass("col-pink");
            $("#CheckPasswordMatch").html("Password match !").addClass('col-cyan');
        } else {
            $("#CheckPasswordMatch").html("Password match !").removeClass('col-cyan');
            $("#CheckPasswordMatch").html("Password does not match !").addClass("col-pink");
        }

    });
});

</script>
@endpush
