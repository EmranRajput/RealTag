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
                                <th>FileName</th>
                                <th>Pending</th>
                                <th>Sent</th>
                                <th>Failed</th>
                                <th>Total Count</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($excelFiles as $file)
                            <tr class="delete_{{$file->id}}">
                                <td> <a href="{{ route('show.file.contacts',$file->id)}}" target="_blank">
                                        {{ @$file->file_name }}</a>
                                </td>
                                <td>{{ @$file->whats_app_msgs_pending_count ?? 0 }}</td>
                                <td>{{ @$file->whats_app_msgs_sent_count ?? 0 }}</td>
                                <td>{{ @$file->whats_app_msgs_failed_count ?? 0 }}</td>
                                <td>{{ @$file->whats_app_msgs_all_count ?? 0 }}</td>
                                <td>
                                    @if(@$file->status == 0)
                                    <button class="btn btn-primary"> Pending</button>
                                    @elseif(@$file->status == 1)
                                    <button class="btn btn-success">Success </button>
                                    @else
                                    <button class="btn btn-danger"> Failed</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $excelFiles->links() }}
                    </div>
                </section>
            </div>
        </div>

    </div>

</section>
@endsection
@push('script')
<script>

</script>
@endpush