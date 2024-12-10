@extends('layout.master')
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

.border-dark {
    border: 1px solid black;
}

.profile-img div span {
    font-size: 40px;
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
                        <h2> {{ @$getData ? 'Edit': 'Create' }} Birthday Template</h2>
                    </div>
                    <div class="body">
                        <form id="" method="POST" action="{{ route('birthday.template.create.update') }}"
                            class="cls-crud-simple-save" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ @$getData->id }}" name="id">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <label for="first_name">Title :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Name" name="name"
                                                value="{{ @$getData->name }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <h5 class="p-1"> Variables:</h5>
                                </div>
                                <div class="col-sm-12 mt-1 mb-2">
                                    <label for="first_name">Press button to add that <b>variable</b> in
                                        description</label><br>
                                    <button class="addName btn btn-primary btn-sm" type="button">{name}</button>
                                    <!-- <button class="addNumber btn btn-primary btn-sm"
                                        type="button">{phone_number}</button> -->
                                </div>
                                <div class="col-sm-12">
                                    <label for="last_name">Description :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line border-dark">
                                            <textarea class="form-control description" rows="3"
                                                placeholder=" Hi {name},happy birthday to you and hope you have a nice day !"
                                                name="description">{{  @$getData->description  }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn {{  @$getData ? 'btn-primary' : 'g-bg-cyan'}}  ">
                                        {{  @$getData ? 'Update' : 'Create'}}</button>
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
// CKEDITOR.replace("ckplot");
// CKEDITOR.instances["ckplot"].setData("<h1> data to render</h1>")
// previewBeforeUpload("file-1");

$(".addName").click(function() {
    var desc = $('.description').val();
    $(".description").val($(".description").val() + " {name}");
});
$(".addNumber").click(function() {
    var desc = $('.description').val();
    $(".description").val($(".description").val() + " {phone_number}");
});
</script>
@endpush