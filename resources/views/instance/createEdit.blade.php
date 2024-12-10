@extends('layout.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header d-flex ">
            <h2>{{ @$instance ? 'Edit Instance':'Create Instance' }}</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div class="card">
                    <div class="header">

                    </div>
                    <div class="body">
                        <form id="" method="POST" action="{{ route('whatsapp.instance.create.update')}}
                    " class="cls-crud-simple-save" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ @$instance->id}}">
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12">
                                    <label for="last_name">Instance Id :<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control instance_id" name="instance_id"
                                                placeholder="Enter Instance Id"
                                                value="{{ @$instance->instance_id ?? old('instance_id')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <label for="last_name">Token :<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control instance_token" name="instance_token"
                                                placeholder="Enter Token"
                                                value="{{ @$instance->instance_token ?? old('instance_token')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label for="last_name">Expiry :<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" class="form-control instance_expiry"
                                                name="instance_expiry" placeholder="Enter Expiry Date"
                                                value="{{ @$instance->instance_expiry ?? old('instance_expiry')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label for="last_name">Start Sleep Timer :<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control " name="start_value"
                                                placeholder="like 0,1,2,3"
                                                value="{{ @$instance->start_value ?? old('start_value')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label for="last_name">End Sleep Timer:<span class="text-danger">*</span>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control " name="end_value"
                                                placeholder="like 8,9,10"
                                                value="{{ @$instance->end_value ?? old('end_value')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-raised g-bg-cyan">Submit</button>
                                    <button type="button" class="btn btn-danger clearEmail">Clear</button>
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
<script>
$(document).on('click', '.clearEmail', function() {
    $('.instance_token').val('');
    $('.instance_id').val('');
    $('.instance_expiry').val('');
});
</script>
@endpush