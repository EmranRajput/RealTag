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

.profile-img div span {
    font-size: 40px;
}
</style>
@endpush
@section('content')
<section class="content profile-page">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12 p-l-0 p-r-0">
                <section class="boxs-simple">
                    <div class="d-flex">
                        <h4>Templates</h4>
                        <a href="{{ route('message.templates.edit')}}" class="create-new">
                            <button class="btn btn-primary  mb-2"> Create New</button></a>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>Description</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($templates as $template)
                            <tr class="delete_{{$template->id}}">
                                <td>{{ @$template->name }}</td>
                                <td>{!! @$template->description !!}</td>
                                <td>
                                    <button class="deleteButton">
                                        <a href="{{ route('message.templates.edit',$template->id)}}">
                                            <i class="fas fa-edit p-2"></i>
                                        </a>
                                    </button>
                                    <button class="deleteButton deleteButtons" data-id="{{ $template->id}}">
                                        <i class=" fas fa-trash text-danger p-2 "></i></button>

                                </td>
                                <td class="is_active_{{@$template->id}}">
                                    @if($template->status == 1)
                                    <button class="btn btn-success activate" data-id="{{ @$template->id}}">
                                        Active</button>
                                    @else
                                    <button class="btn btn-danger activate" data-id="{{ @$template->id}}">
                                        Deactive</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </section>
            </div>
        </div>


    </div>
</section>
@endsection
@push('script')
<script>
$(".deleteButtons").click(function() {
    var del_id = $(this).attr("data-id");
    var _url = "{{ route('message.template.delete')}}";
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: _url,
                data: {
                    id: del_id
                },
                success: function(response) {
                    if (response.success) {
                        $('.delete_' + del_id).remove();
                        $('.message').addClass('text-success').text(
                            'Action Performed Successfully.')
                    } else {
                        $('.message').addClass('text-danger').text(
                            'Action Failed!Please try again later.')
                    }
                }
            });
        }
    });
});



$(document).on('click', '.activate', function() {
    var id = $(this).attr("data-id");
    var _url = "{{ route('message.template.active.update.deactive')}}";
    $.ajax({
        type: "POST",
        url: _url,
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {
                if (response.status == 1) {
                    showAlert(1, "Message Template is activated");
                    $('.is_active_' + id).html(
                        '<button class="btn btn-success activate" data-id="' +
                        id +
                        '"> Active</button>');
                } else if (response.status == 0) {
                    showAlert(1, "Message Template is deactivated");
                    $('.is_active_' + id).html(
                        '<button class="btn btn-danger activate" data-id="' +
                        id +
                        '"> Deactive</button>');
                }
            } else {
                showAlert(0, "Message Template is deactivate");
            }
        }
    });
});
</script>
@endpush