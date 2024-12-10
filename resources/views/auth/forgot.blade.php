@extends('layout.master-without-nav')
@section('content')
<div class="container">
    {{-- <div class="card-top"></div> --}}
    <div class="card">
        <h1 class="title"><span>{!! siteName() !!}</span>{{ $title}} </h1>
        <div class="body">
            <form id="frm" method="post" class="cls-form-validate" action="{!! route('forget.password-submit') !!}" >
                @csrf
                <div class="input-group icon before_span">
                    <span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="email" placeholder="Email" required value="{{ old('email') }}" autofocus>
                    </div>
                </div>
                <div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-raised waves-effect {!! getButtonClass() !!}">RESET PASSWORD</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@push('script')
@endpush
