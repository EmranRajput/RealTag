<!-- Top Bar -->
<nav class="navbar clearHeader">
    <div class="col-12">
        <div class="navbar-header"> <a href="javascript:void(0);" class="bars"></a> <a class="navbar-brand" href="{{routePut('app.dashboard')}}">{{env('APP_SHORT_NAME')}}</a> </div>
        <ul class="nav navbar-nav navbar-right">
            <!-- Notifications -->
{{--            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i> <span class="label-count">7</span> </a>--}}
{{--                <ul class="dropdown-menu">--}}
{{--                    <li class="header">NOTIFICATIONS</li>--}}
{{--                    <li class="body">--}}
{{--                        <ul class="menu">--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);">--}}
{{--                                    <div class="icon-circle bg-light-green"><i class="zmdi zmdi-account-add"></i></div>--}}
{{--                                    <div class="menu-info">--}}
{{--                                        <h4>12 new members joined</h4>--}}
{{--                                        <p><i class="material-icons">access_time</i> 14 mins ago</p>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);">--}}
{{--                                    <div class="icon-circle bg-cyan"><i class="zmdi zmdi-shopping-cart-plus"></i></div>--}}
{{--                                    <div class="menu-info">--}}
{{--                                        <h4>4 sales made</h4>--}}
{{--                                        <p><i class="material-icons">access_time</i> 22 mins ago</p>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);">--}}
{{--                                    <div class="icon-circle bg-red"><i class="zmdi zmdi-delete"></i></div>--}}
{{--                                    <div class="menu-info">--}}
{{--                                        <h4><b>Nancy Doe</b> deleted account</h4>--}}
{{--                                        <p><i class="material-icons">access_time</i> 3 hours ago</p>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);">--}}
{{--                                    <div class="icon-circle bg-orange"><i class="zmdi zmdi-edit"></i></div>--}}
{{--                                    <div class="menu-info">--}}
{{--                                        <h4><b>Nancy</b> changed name</h4>--}}
{{--                                        <p><i class="material-icons">access_time</i> 2 hours ago</p>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);">--}}
{{--                                    <div class="icon-circle bg-blue-grey"><i class="zmdi zmdi-comment-alt-text"></i></div>--}}
{{--                                    <div class="menu-info">--}}
{{--                                        <h4><b>John</b> commented your post</h4>--}}
{{--                                        <p><i class="material-icons">access_time</i> 4 hours ago</p>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);">--}}
{{--                                    <div class="icon-circle bg-light-green"><i class="zmdi zmdi-refresh-alt"></i></div>--}}
{{--                                    <div class="menu-info">--}}
{{--                                        <h4><b>John</b> updated status</h4>--}}
{{--                                        <p><i class="material-icons">access_time</i> 3 hours ago</p>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);">--}}
{{--                                    <div class="icon-circle bg-purple"><i class="zmdi zmdi-settings"></i></div>--}}
{{--                                    <div class="menu-info">--}}
{{--                                        <h4>Settings updated</h4>--}}
{{--                                        <p><i class="material-icons">access_time</i> Yesterday</p>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="footer"> <a href="javascript:void(0);">View All Notifications</a> </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <!-- #END# Notifications -->
            <!-- Tasks -->
{{--            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-flag"></i><span class="label-count">9</span> </a>--}}
{{--                <ul class="dropdown-menu">--}}
{{--                    <li class="header">TASKS</li>--}}
{{--                    <li class="body">--}}
{{--                        <ul class="menu tasks">--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);">--}}
{{--                                    <h4> Task 1 <small>32%</small> </h4>--}}
{{--                                    <div class="progress">--}}
{{--                                        <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%"> </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);">--}}
{{--                                    <h4>Task 2 <small>45%</small> </h4>--}}
{{--                                    <div class="progress">--}}
{{--                                        <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%"> </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);">--}}
{{--                                    <h4>Task 3 <small>54%</small> </h4>--}}
{{--                                    <div class="progress">--}}
{{--                                        <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%"> </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="javascript:void(0);">--}}
{{--                                    <h4> Task 4 <small>65%</small> </h4>--}}
{{--                                    <div class="progress">--}}
{{--                                        <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%"> </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="footer"><a href="javascript:void(0);">View All Tasks</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <!-- #END# Tasks -->
{{--            <li><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="zmdi zmdi-settings"></i></a></li>--}}
            <li><a href="{{route('app.profile')}}" title="Go to Profile"><i class="zmdi zmdi-account"></i></a></li>
            <li><a href="{{route('app.logout')}}" title="sign out" ><i class="zmdi zmdi-sign-in "></i></a></li>
        </ul>
    </div>
</nav>
<!-- #Top Bar -->

@push('modals')
    <div id="modalNotification" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Notification</h4>
                </div>
                <div class="modal-body">
                </div>

            </div>
        </div>
    </div>
@endpush
{{-- @push('script')
    <script>
        var dtNotificationTable;

        function getNotification(url) {
            modalForm('#modalNotification', url, function(status) {});
        }

        function getAllNotification() {
            jQuery.ajax({
                type: "get",
                url: "{!! route('get-all-unread-notification') !!}",
                success: function(res) {

                    if (res.status) {
                        jQuery("#notification_count").text(res.total)
                        jQuery("#notification_body").html(res.body);
                    }
                }
            });
        }

        function changeNotificationStatus(id) {
            swal({
                title: "Are you sure to mark this notification as read?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#FB483A',
                confirmButtonText: "Yes",
                closeOnConfirm: true,
                showLoaderOnConfirm: true,
            }, function(isConfirm) {
                if (isConfirm) {
                    var total = jQuery("#notification_count").text();
                    jQuery.ajax({
                        type: "post",
                        url: "{!! routePut('change-notification-status') !!}",
                        data: {
                            "id": id
                        },
                        success: function(res) {
                            ajaxSucc(res);
                            if (dtNotificationTable != undefined) {
                                simpleDataTableRefresh(dtNotificationTable);
                            }
                            jQuery("#notification_count").text(total - 1);
                            jQuery("#modalNotification").modal('hide');
                        },
                        error: function(res) {
                            ajaxErr(res);
                        }
                    });
                }
            });
        }
    </script>
@endpush --}}
