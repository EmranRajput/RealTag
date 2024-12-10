@extends('layout.master')
@section('title')
    Add Agent
@endsection
@section('css')
    <!-- choices css -->
    <!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">



  
@endsection
@section('page-title')
    Add Agent
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create New Agent</h4>
                        <p class="card-title-desc">we will email you the form and process of agent requirements.</p>
                    </div>
                    <div class="card-body">

                        <form id="email_frm1" method="POST" action="{!! $urlSave !!}" class="cls-crud-simple-save needs-validation" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="mb-3">
                                         @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        <label class="form-label">Email :</label>
                                        <input type="text" class="form-control input_email" data-email="email" name="email"placeholder="Enter Your Email" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid email!
                                        </div>
                                        <!--<input type="text" class="form-control" id="datepicker-basic">-->
                                    </div>
                                </div>

                                <div class="row mt-2">
                            <div class="col-12">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"> Cancel</button>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal" id="btn-save-event">
                                    Send</button>
                            </div>
                        </div>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        
        <div id="success-btn1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="success-btnLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="bx bx-check-circle display-1 text-success"></i>
                        <h4 class="mt-3" id="modal-title"> Email has been send</h4>
                        <p id="modal-content">;l;ajsd;lfjas;lja;lasjf;</p>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
        


        <!-- end row -->
    @endsection
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
        function showAlert(status, message) {
            Swal.fire({
                icon: status ? 'success' : 'error',
                text: message,
                timer: 1500,  // Set the duration in milliseconds (1.5 seconds)
                showConfirmButton: false
            });
        }
        
$('#email_frm1').submit(function(e) {
    e.preventDefault(); 
    var formAction = $(this).attr('action');

    $.ajax({
        type: "POST",
        url: formAction,
        data: $(this).serialize(),
        success: function(response) {
            
            // Show the modal
            $('#success-btn1').modal('show');

            // Optionally, you can set a timeout to hide the modal and reload the page
            setTimeout(function() {
                $('#success-btn1').modal('hide');
                window.location.reload();
            }, 2000);
        },
        error: function(error) {
            // For error handling, show the modal with error details or use a different approach
            $('#modal-title').text('Failed to send email');
            $('#modal-content').text('Please try again later.'); // Customize based on the error response or keep generic
            $('#success-btn1').modal('show');

            console.error(error);
        }
    });
});


    </script>
    @section('scripts')
        <script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            $(document).on('click', '.clearEmail', function() {
                $('.input_email').val('');
            });
        </script>
    @endsection

