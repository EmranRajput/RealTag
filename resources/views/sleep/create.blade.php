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

.profile-img div span {
    font-size: 40px;
}

.pass {
    border: none;
    background: inherit;
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
                        <h2>Security</h2>
                    </div>
                    <div class="body">
                        <form method="POST" action="{{ route('whatsapp.instance.sleep.timer.update')}}"
                            class="cls-crud-simple-save">
                            @csrf
                            <div class="input-group">
                                <label for="last_name">Start Value:<span class="text-danger">*</span>
                                </label>
                                <div class="form-line d-flex">
                                    <input type="number" id="password" class="form-control" name="start_value"
                                        placeholder="like 0,1,2" required
                                        value="{{ @$data['start_value'] ?? old('start_value') }}">

                                </div>
                            </div>
                            <div class="input-group">
                                <label>End Value :<span class="text-danger">*</span></label>
                                <div class="form-line d-flex">
                                    <input type="number" id="confirm_password" class="form-control" name="end_value"
                                        placeholder=" like 5,6,7" required
                                        value="{{  @$data['end_value'] ?? old('end_value') }}">

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
previewBeforeUpload("file-1");
</script>
@endpush