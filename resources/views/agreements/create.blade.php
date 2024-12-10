@extends('layout.master-inner')
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
                        <h2> {{ @$getData ? 'Edit': 'Create' }} Agreement</h2>
                    </div>
                    <!--<select class="form-control" id="constants_dropdown">-->
                    <!--    @foreach ($constants as $constant)-->
                    <!--        <option value="{{ $constant->constant }}">{{ $constant->name }}</option>-->
                    <!--    @endforeach-->
                    <!--</select>-->
                    <div class="col-sm-3 ">
                        <div class="form-group">
                            <div class="form-line">
                        <select class="form-control select-tenant" id="constants_dropdown">
                            <option value="">Agreement</option>
                            @foreach ($constants as $constant)
                            <option value="{{ $constant->constant }}">{{ $constant->name }}</option>
                             @endforeach
                        </select>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <form id="frm" method="POST" action="{{ route('agreements.create.update') }}"
                            class="cls-crud-simple-save" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ @$getData->id }}" name="id">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <label for="last_name">Title :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line border-dark">
                                            <input type="text" class="form-control" name="title"
                                                value="{{ @$getData->title ??  old('title') }}" required>

                                        </div>
                                    </div>
                                </div>

                                <div class=" col-sm-12">
                                    <label for="last_name">Description :<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <div class="form-line border-dark">
                                            <input type="hidden" name="descriptions" id="hiddenInput">
                                            <textarea class="form-control" id="editor" rows="3" name="editor"
                                                required>{{  @$getData->descriptions  }}</textarea>
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
CKEDITOR.replace('editor');
document.getElementById('frm').addEventListener('submit', function() {
    var editor = CKEDITOR.instances.editor;
    var content = editor.getData();
    document.getElementById('hiddenInput').value = content;
});
// previewBeforeUpload("file-1");

// on change of constants dropdown, copy value to clipboard
document.getElementById("constants_dropdown").addEventListener("change", myFunction);

function myFunction() {
  //alert(document.getElementById("constants_dropdown").value);
   // Copy the text inside the text field
  navigator.clipboard.writeText(document.getElementById("constants_dropdown").value);
}

</script>
@endpush