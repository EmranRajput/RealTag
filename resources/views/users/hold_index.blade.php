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

.search {
    margin: auto;
    margin-right: 0px;
}

.search-form {
    display: flex;
}

.search-form input {
    flex: 1;
    /* Add other input styles if needed */
}

.search-form button {
    margin-left: 5px;
    /* Add other button styles if needed */
}
.shadow-right {
    box-shadow: 5px 0 5px rgba(0, 0, 0, 0.2); /* Adjust the values as needed */
}
.container-fluid span{
    margin-left : 5px;
}
</style>
@endpush
@section('content')
<section class="content profile-page">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12 p-l-0 p-r-0">
                <section class="boxs-simple">
                    <h4>Users</h4>
                    <div class="">
                        <div class="row mt-3">

                            <div class="col-md-6"></div>

                            <div class="col-md-6">
                                <div class="row">
                                    <form action="{{ route('show.users') }}" method="GET" class="row">
                                        <div class="col-md-4">
                                            <select name="role" class="form-control ">
                                                <option value="">Select</option>
                                                <option value="1" {{ request('role')  == 1 ? 'selected' : '' }}>
                                                    Admin</option>
                                                <option value="2" {{ request('role')  == 2 ? 'selected' : '' }}>Agent
                                                </option>
                                                <option value="3" {{ request('role')  == 3 ? 'selected' : '' }}>Talent
                                                </option>
                                                <option value="4" {{ request('role')  == 4 ? 'selected' : '' }}>Land
                                                    Lord</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control" placeholder="Search...">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>

                    </div>
                    <table id="examplea" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>IC / Passport Number</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Active Status</th>
                                 <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="delete_{{$user->id}}">
                                <td>{{ @$user->name  ?? '--'}}</td>
                                <td>{{ @$user->email ?? '--' }}</td>
                                <td>{{ @$user->identity_number ?? '--'}}</td>
                                <td>{{ @$user->phone_number ?? '--' }}</td>
                                <td>{{ @getUserRole($user->role) ?? '--'}}</td>
                                <td class="is_active_{{@$user->id}}">
                                    @if($user->is_active == 1)
                                    <button class="btn btn-success activate" data-id="{{ @$user->id}}"> Active</button>
                                    @else
                                    <button class="btn btn-danger activate" data-id="{{ @$user->id}}">
                                        Deactive</button>
                                    @endif
                                </td>
                                <td><button type="button" class="btn btn-info btn-lg btn-sm userProfile1"  data-id="{{ @$user->id}}" data-toggle="modal" data-target="#myModal11">
                                    <i class="fas fa-eye"></i></button></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-right mt-3">
                        {{ $users->links() }}
                    </div>


                </section>
            </div>
        </div>
    </div>
</section>
<!--model popup for show  profile data -->
<div class="modal fade" id="myModal11">
  <div class="modal-dialog ">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header shadow-lg" style="background: linear-gradient(45deg, #49c5b6, #ab9ae5);">
        <h2 class="modal-title ml-3 text-light">Profile Information</h2>
        <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <!-- Left Side Content -->
            <div class="col-md-6">
                
            <img class="rounded-circle shadow-right" id="profile"  src="" alt="" style="width: 100px; height: 100px; margin-bottom: 15px;">
             <p><strong>Name:</strong><span id="user_name"></span></p>
             <p><strong>Email:</strong><span id="user_email"></span></p>

              </div>
              <div class="col-md-6">
              <p><strong>Identity Number:</strong><span id="user_id_number"></span></p>
              <p><strong>Phone Number:</strong><span id="user_phone_number"></span></p>
              <p><strong>Role:</strong> <span id="user_role"></span></p>
              <p><strong>Birthday:</strong><span id="user_birthday"></span></p>
              <p><strong>Status:</strong><span id="user_status"></span></p>
              </div>
            </div>
          </div>
        </div>
            <!-- Modal Footer -->
            <!--<div class="shadow-sm ">-->
            <!--</div>-->
              <div class="modal-footer">
                <!--<button type="button" class="btn btn-primary ml-4"  id="agrement1_id">Agreement View</button>-->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>

            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "paging": false,
        "info": false
    });

});

$(document).on('click', '.activate', function() {
    var id = $(this).attr("data-id");
    var _url = "{{ route('users.active.deactive')}}";
    $.ajax({
        type: "POST",
        url: _url,
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {

                if (response.status == 1) {
                    showAlert(1, "User is activated");
                    $('.is_active_' + id).html(
                        '<button class="btn btn-success activate" data-id="' + id +
                        '"> Active</button>');
                } else if (response.status == 0) {
                    showAlert(1, "User is deactivated");
                    $('.is_active_' + id).html(
                        '<button class="btn btn-danger activate" data-id="' + id +
                        '"> Deactive</button>');
                }
            } else {
                showAlert(0, "User is deactivate");
            }
        }
    });
});
//popup model show
$(".userProfile1").on('click', function() {
    var id = $(this).attr("data-id");
    var _url = "{{ route('show.getUserProfile')}}";
    $.ajax({
        type: "POST",
        url: _url,
        data: {
            id: id
        },
        success: function(response) {
            if (response.success) {
                // var users = response.users.[0]; // Access the first tenant if it exists
                // // var = 
                if(response.users.status!=1){
                    var user_status = "Deactivated";   
                }else{
                    var user_status = "Active";
                }
                
                 var user_role;
                if (response.users.role == 1) {
                    user_role = "Admin";   
                } else if (response.users.role == 2) {
                    user_role = "Agent";   
                } else if (response.users.role == 3) {
                    user_role = "Landlord";   
                } else {
                    user_role = "Tenant";
                }
                // if (response.users.profile_photo) {
                //     // Set the 'src' attribute of the image tag to the profile image URL
                //     profile_photo=.attr("src", response.users.profile_image);
                // } else {
                //     // If there is no profile image, you can set a default image or hide the image tag
                //     profileImage.attr("src", "path/to/default-image.jpg");
                //     // OR
                //     // profileImage.hide();
                // }
                
                
                // }
                $("#profile").attr("src", '/public/uploads/profile/general/' + response.users.profile_photo);
                $("#user_name").text(response.users.name);
                $("#user_email").text(response.users.email);
                $("#user_id_number").text(response.users.identity_number);
                $("#user_phone_number").text(response.users.phone_number);
                $("#user_role").text(user_role);
                $("#user_birthday").text(response.users.birth_date);
                $("#user_status").text(user_status);
                $('#myModal11').modal('userProfile1');
                
            } else {
                showAlert(0, "user deactivated");
            }
        }
    });
});

</script>
@endpush
<!--src="{{ asset('assets/images/image-1.jpg') }}"-->