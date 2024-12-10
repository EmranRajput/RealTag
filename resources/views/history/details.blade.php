@extends('layout.master')
@section('title')
    History
@endsection
<link rel="stylesheet" href="{{ URL::asset('../build/libs/gridjs/theme/mermaid.min.css') }}">
<!--@section('css')-->
    
<!--@endsection-->
@section('page-title')
 History
@endsection
@section('body')
    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        </div>
        <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!--  Extra Large modal example -->
        
    @endsection
    @section('scripts')
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
    @endsection
