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
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color:#23fd0f;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
                        <h4>Tenant</h4>
                        <a href="{{ route('agent.tenant.downloadContact')}}" class="create-new" style="margin-right: -50%;">
                            <button class="btn btn-warning  mb-2" style="color:#ffffff"> <i class="fa fa-file-csv"></i> Export Contact</button></a>
                        <a href="{{ route('agent.tenants.edit')}}" class="create-new">
                            <button class="btn btn-primary  mb-2"> <i class="fa fa-plus"></i> Create New</button></a>
                        <form action="{{ route('agent.tenants') }}" method="GET" class="row">

                            <div class="col-md-8">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Search...">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                            </div>
                        </form>

                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th> IC / Passport Number</th>
                                <!-- <th>Action</th> -->
                                <th>Status</th>
                                <th>Birhtday Reminder</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($templates as $template)
                            <tr class="delete_{{$template->id}}">
                                <td>{{ @$template->name }}</td>
                                <td>{!! @$template->email !!}</td>
                                <td>{!! @$template->phone_number !!}</td>
                                <td>{!! @$template->identity_number !!}</td>
                                <!-- <td>
                                    <button class="deleteButton">
                                        <a href="{{ route('agent.tenants.edit',$template->id)}}">
                                            <i class="fas fa-edit p-2"></i>
                                        </a>
                                    </button>
                                    <button class="deleteButton deleteButtons" data-id="{{ $template->id}}">
                                        <i class=" fas fa-trash text-danger p-2 "></i></button>

                                </td> -->
                                <td class="is_active_{{@$template->id}}">
                                    @if($template->status == 1)
                                    <button class="btn btn-success activate" data-id="{{ @$template->id}}">
                                        Active</button>
                                    @else
                                    <button class="btn btn-danger activate" data-id="{{ @$template->id}}">
                                        Deactive</button>
                                    @endif
                                </td>
                                  <td>
                                  <label class="switch">
                                    <input type="checkbox" class="reminder_toggle"  data-user_id="{{@$template->id}}" {{$template->bstatus == 1 ? 'checked="checked"' : ''}}>
                                    <span class="slider round"></span>
                                  </label>
                            </td>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
            {{ @$templates->links()}}
        </div>
    </div>
</section>
@endsection
@push('script')
<script>
$(document).ready(function(){
    $('.reminder_toggle').on('change', function() {
    var _url = "{{ route('agent.landlord.birthday.notification')}}";
    var status = $(this).prop('checked') ? '1' : '0';
    // alert(status);
    var user_id = $(this).data('user_id');
            
     $.ajax({
            type: "POST",
            url: _url,
            data: {
                reminderInput : status,
                user_id : user_id
            },
            success: function(response) {
            if (response.success) {
                    if (response.status == 1) {
                        showAlert(1, "Notification Updated.");
                    } else {
                        showAlert(0, "Notification is not updated.");
                    }
                }
            }
    }); 
        
  }); 
})

$(".deleteButtons").click(function() {
    var del_id = $(this).attr("data-id");
    var _url = "{{ route('agent.tenants.delete')}}";
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
                        showAlert(1, "Tenant is removed");
                        // $('.message').addClass('text-success').text('Account is deleted.')
                    } else {
                        showAlert(0, "Action Failed! Please try again later.");
                        // $('.message').addClass('text-danger').text(
                        //     'Action Failed! Please try again later.')
                    }
                }
            });
        }
    });
});

 $(document).on('click', '.activate', function() {
    var id = $(this).attr("data-id");
    var _url = "{{ route('agent.tenants.active.update.deactive')}}";
    $.ajax({
        type: "POST",
        url: _url,
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {
                if (response.status == 1) {
                    showAlert(1, "Account is activated");
                    $('.is_active_' + id).html(
                        '<button class="btn btn-success activate" data-id="' +
                        id +
                        '"> Active</button>');
                } else if (response.status == 0) {
                    showAlert(1, "Account is deactivated");
                    $('.is_active_' + id).html(
                        '<button class="btn btn-danger activate" data-id="' +
                        id +
                        '"> Deactive</button>');
                }
            } else {
                showAlert(0, "Tanent is deactivate");
            }
        }
    });
});


</script>
@endpush