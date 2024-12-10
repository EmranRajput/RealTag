@extends('layout.auth')
@section('content')
<div class="container">
    <div class="card-top"></div>
    <div class="card">
        <h1 class="title"><span>{!! siteName() !!}</span>Error 404 <div class="msg">Page not found</div></h1>
        <div class="body text-center">
            <div> <a class="btn btn-raised  waves-effect {!! getButtonClass() !!}" href="{!! route('app.login') !!}">GO TO LOGIN</a> </div>
        </div>
    </div>
</div>
@stop
@push('script')
@endpush