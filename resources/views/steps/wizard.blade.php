@extends('layout.master-inner')
@section('content')
<style>
* {
    margin: 0;
    padding: 0;
}

html {
    height: 100%;
}

/*Background color*/
#grad1 {
    /*background-color: #9C27B0;*/
    /* background-image: linear-gradient(120deg, #FF4081, #81D4FA); */

    /*background-image: linear-gradient(120deg, #00bab7, #dd8eed);*/
}

/*form styles*/
#msform {
    text-align: center;
    position: relative;
    /* margin-top: 20px; */
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    padding: 0px 0px 0px 20px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 2px 3%;
    /*stacking fieldsets above each other*/
    position: relative;
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;

    /*stacking fieldsets above each other*/
    position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}

#msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E;
}

#msform input,
#msform textarea {
    padding: 0px 8px 4px 8px;
    border: none;
    border-bottom: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 16px;
    letter-spacing: 1px;
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    border-bottom: 2px solid skyblue;
    outline-width: 0;
}

/*Blue Buttons*/
#msform .action-button {
    width: 100px;
    background: skyblue;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .upload-button {
    width: 100px;
    background: skyblue;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .upload-button:hover,
#msform .upload-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
}


#msform .action-button:hover,
#msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
}

/*Previous Buttons*/
#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
}

/*Dropdown List Exp Date*/
select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px;
}

select.list-dt:focus {
    border-bottom: 2px solid skyblue;
}

/*The background card*/
.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative;
}

/*FieldSet headings*/
.fs-title {
    font-size: 17px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left;
}

/*progressbar*/
#progressbar {
    /* margin-bottom: 30px; */
    // overflow: hidden;
    color: lightgrey;
}

#progressbar .active {
    color: #000000;
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 50%;
    float: left;
    position: relative;
}

/*Icons in the ProgressBar*/
#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f023";
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f007";
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f09d";
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c";
}

/*ProgressBar before any progress*/
#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
}

/*ProgressBar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1;
}

/*Color number of the step and the connector before it*/
#progressbar li.active:before,
#progressbar li.active:after {
    background: skyblue;
}

/*Imaged Radio Buttons*/
.radio-group {
    position: relative;
    margin-bottom: 25px;
}

.radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px;
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
}

.h-500 {
    height: 600px;
}

/*Fit image in bootstrap div*/
.fit-image {
    width: 100%;
    object-fit: cover;
}

.auto-scroll {
    overflow-y: auto;
    max-height: 550px;
}

.cursor-pointer {
    cursor: pointer;
}
</style>
<section class="content">
    <div class="container-fluid">
        <div class=" d-flex ">
        </div>
    </div>
    <div class="container-fluid" id="grad1">
        <div class="row justify-content-center mt-0 h-500 ">
            <div class="col-11 col-sm-9 col-md-7 col-lg-8 text-center p-0 mt-1 mb-2 ">
                <div class="card px-0 pt-4 pb-0 mt-1 mb-3 auto-scroll">
                    <div class="col-md-12 mx-0">
                        @if(session('success'))
                        @if(session('message_sent'))
                        <i class="fa-solid fa-check-circle fa-4x text-success"></i>
                        <h5 class="text-success mb-5">Please sit tight! We are sending your messages.</h5>
                        @endif

                        @if(session('data'))
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    @foreach(getHeadersFromArray() as $key => $arr)
                                    <th scope="col">{{ucfirst($arr)   }}</th>
                                    @endforeach
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(session('data') as $key => $numbers )
                                <tr class="id_{{$key}}">

                                    @foreach($numbers as $k => $number)

                                    <td>{{ @$number }}</td>
                                    @endforeach
                                    <td class="remove_item" data-id="{{$key}}"> <i
                                            class="fa fa-trash text-danger cursor-pointer " aria-hidden="true"></i>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('send.sms.whatsapp')}}" target="_blank"> <button class="btn btn-primary mb-3">
                                Send
                                Message
                            </button> </a>
                        @endif
                        @else
                        <form id="msform" action="{{ route('whatsapp.instance.import.excel')}}" method="post"
                            enctype="multipart/form-data">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong> QRCode
                                    </strong></li>
                                <li id="personal"><strong>File Import</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                @if($response == 'already-exist')
                                <div>
                                    <a href="{{ route('whatsapp.instance.logout')}}"><span
                                            class="float-right text-danger"> <i class="fa fa-sign-out"
                                                aria-hidden="true"></i>Logout</span></a>

                                </div>
                                <div class="">
                                    <i class="fa-regular fa-check-circle fa-4x  text-success"></i>
                                    <h6 class="text-success mb-5 mt-5">You are already logged In.Press next to
                                        upload file.
                                    </h6>
                                    <input type="hidden" class="recheck" value="1">
                                </div>
                                <div class="form-group">
                                    <label for="formFileSm" class="form-label">Enter WhatsApp that you
                                        scanned.
                                    </label>
                                    <input class="form-control form-control-sm phone_number" id="formFileSm"
                                        type="number" name="number" />
                                </div>
                                <button type="button" class="btn btn-primary next-btn" name="next">Next</button>
                                @elseif($response == 'error')
                                <div class="">
                                    <i class="fa-regular fa-circle-exclamation fa-4x  text-primary"></i>
                                    <h6 class="text-primary mb-5 mt-5">All Instances are busy right now! Please
                                        Wait.</h6>
                                </div>

                                @else
                                <div class="form-card text-center">
                                    @php $imageType = 'png' @endphp
                                    <img width="270px" src="data:{{ $imageType }};base64,{{ base64_encode($response) }}"
                                        alt="">
                                </div>
                                <div class="form-group">
                                    <label for="formFileSm" class="form-label">Enter WhatsApp that you
                                        scanned.
                                    </label>
                                    <input class="form-control form-control-sm phone_number" id="formFileSm"
                                        type="number" name="number" />
                                </div>

                                <button type="button" class="btn btn-primary next-btn" name="next">Next</button>
                                @endif
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h4 class="fs-title">Upload File</h4>
                                    @csrf
                                    <div>
                                        <label for="formFileSm" class="form-label">Choose Template</label>
                                        <select name="template" id="" class="form-control">
                                            @foreach($templates as $template)
                                            <option value="{{ @$template->id }}">{{ $template->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="formFileSm" class="form-label">File input example</label>
                                        <input class="form-control form-control-sm" id="formFileSm" type="file"
                                            name="file" />
                                        @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="button" class=" btn btn-secondary  previous">Previous</button>
                                <button type="submit" name="submit" class="btn btn-primary" value="Upload">Upload
                                </button>
                            </fieldset>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@stop
@push('script')
<script>
$(document).ready(function() {
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    $(".remove_item").click(function() {
        var remove_id = $(this).attr("data-id");
        var url = "{{ route('update.csv.session') }}";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                remove_id: remove_id
            },
            success: function(response) {
                if (response.status) {
                    $('.id_' + remove_id).remove();
                }
            },
        });
    });

    $(".next-btn").click(function() {
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        checkAgentStatus(function(callback) {
            if (!callback) {
                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass(
                    "active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 600
                });
            } else {
                alert('Some Error Occured')
            }
            // console.log(callback, 'callback callback');
        });

    });

    function checkAgentStatus(callback) {
        var number = $('.phone_number').val();
        var recheck = $('.recheck').val();
        if (!number) {
            showAlert(0, "Please enter your whatsapp number.");
            return false;
        }
        if (number.length < 7) {
            showAlert(0, "Number length must be greater then 7.");
            return false;
        }
        var url = "{{ route('check.agent.whatsapp.number') }}";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                number: number,
                recheck: recheck
            },
            success: function(response) {
                if (response.status) {
                    // when logout the user
                    // showAlert(0, "You're logged out. Please scan QR code again to proceed.");
                    // logoutUser();

                    // if (number) {
                    //     showAlert(0, "Please wait !Instance is not Available yet.");
                    // } else {
                    //     showAlert(0, "Please scan Qrcode first then upload file!");
                    // }
                    // getAgentPhoneNumber(callback)
                    showAlert(0, "Number is not correct ! Please enter correct number.");
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    callback(false);
                }
            },
        });
    }

    function logoutUser() {
        var url = "{{ route('whatsapp.instance.logout','true') }}";
        $.ajax({
            type: 'get',
            url: url,

            success: function(response) {
                if (response.status) {
                    setTimeout(function() {
                        location.reload();
                    }, 3000);

                }
            },
        });
    }

    function getAgentPhoneNumber(callback) {
        var url = "{{ route('check.agent.whatsapp.number') }}";
        $.ajax({
            type: 'POST',
            url: url,
            success: function(response) {
                if (response.status) {

                } else {}
            },
        });
    }
    $(".previous").click(function() {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({
                    'opacity': opacity
                });
            },
            duration: 600
        });
    });

    $('.radio-group .radio').click(function() {
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });

    $(".submit").click(function() {
        return false;
    })

});
</script>
@endpush