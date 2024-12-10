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
</style>
@endpush
@section('content')
<section class="content profile-page">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12 p-l-0 p-r-0">
                <section class="boxs-simple">
                    <div class="d-flex">
                        <h4>History</h4>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Status</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $file)
                            <tr class="delete_{{$file->id}}">
                                <td>{{ @$file->number }}</td>
                                <td>
                                    @if(@$file->status == 0)
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    @elseif(@$file->status == 1)
                                    <i class="fa fa-check-circle text-success"></i>

                                    @else
                                    <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>


                                    @endif
                                </td>
                                <td style="width: 400px;">
                                    {{ @$file->message }}
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
$(".resend-link").click(function() {
    var id = $(this).attr("data-id");
    var _url = "{{ route('resend.whatsapp.message.link')}}";
    $.ajax({
        type: "POST",
        url: _url,
        data: {
            id: id
        },
        success: function(response) {
            if (response.status) {
                showAlert(1, "Message resent successfuly!");
            } else {
                showAlert(0, "Action Failed!Please try again later.");
            }
        }
    });
});
</script>
@endpush