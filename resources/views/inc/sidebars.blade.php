<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">

            <div class="admin-image">
                @if(isset(userLogin()->profile_photo))

                <img class="sidebar-img" src="{{ userLogin()->getProfilepic(1) }}" alt="">
                @else
                <img class="sidebar-img" src="{{ asset('assets/images/default.png') }}" alt="">
                @endif
            </div>
            <div class="admin-action-info"> <span>Welcome &nbsp; {{ logRolePrint() }}</span>
                <h3 class="white-space-no-wrap">{!! logName() !!}</h3>
                <ul>
                    <li><a href="{{route('app.profile')}}" title="Go to Profile"><i class="zmdi zmdi-account"></i></a>
                    </li>
                    <li><a href="{{route('app.logout')}}" title="sign out"><i class="zmdi zmdi-sign-in"></i></a></li>
                </ul>
            </div>
            {{--            <div class="quick-stats">--}}
            {{--                <h5>Today Report</h5>--}}
            {{--                <ul>--}}
            {{--                    <li><span>16<i>Agents</i></span></li>--}}
            {{--                    <li><span>20<i>Landlord</i></span></li>--}}
            {{--                    <li><span>04<i>Tenent</i></span></li>--}}
            {{--                </ul>--}}
            {{--            </div>--}}
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <?php
            $menuArr = [];
            if (isAdmin()) {
                $menuArr[] = [
                    'icon' => '<i class="zmdi zmdi-home"></i>',
                    'route' => 'app.dashboard',
                    'title' => 'Dashboard',
                ];
                $menuArr[] = [
                    'icon' => '<i class="material-icons">people</i>',
                    'route' => 'add.agent',
                    'title' => 'Agents',
                ];
               
                $menuArr[] = [
                    'icon' => '<i class="material-icons">description</i>',
                    'route' => 'user.agreements',
                    'title' => 'Agreements',
                ];
                $menuArr[] = [
                    'icon' => '<i class="material-icons">cake</i>',
                    'route' => 'birthday.templates',
                    'title' => 'Birthday Templates ',
                ];
                $menuArr[] = [
                    'icon' => '<i class="material-icons">description</i>',
                    'route' => 'rental.templates',
                    'title' => 'Rental Templates ',
                ];

                $menuArr[] = [
                    'icon' => '<i class="material-icons">assignment_ind</i>',
                    'route' => 'whatsapp.instance.index',
                    'title' => 'Instances ',
                ];

                 $menuArr[] = [
                    'icon' => '<i class="material-icons">group</i>',
                    'route' => 'show.users',
                    'title' => 'Users ',
                ];
                
              
                
                
                
//                $menuArr[] = [
//                    'icon' => '<i class="material-icons">message</i>',
//                    'childs' => [['title' => 'WhatsApp Message Template List', 'route' => 'message.index'],['title' => 'Rental Reminder Email List', 'route' => 'email.index'], ['title' => 'Add New', 'route' => 'message.add']],
//                    'title' => 'Message Template',
//                ];
//                $menuArr[] = [
//                    'icon' => '<i class="material-icons">insert_drive_file</i>',
//                    'childs' => [['title' => 'List', 'route' => 'template.index'], ['title' => 'Add New', 'route' => 'template.add']],
//                    'title' => 'Upload Template',
//                ];
//                $menuArr[] = [
//                    'icon' => '<i class="zmdi zmdi-file-text"></i>',
//                    'childs' => [['title' => 'Sales', 'route' => 'report.sales']],
//                    'title' => 'Reports',
//                ];
            }
            if (isAgent()) {
//                $menuArr[] = ['heading' => 'MAIN NAVIGATION'];
                $menuArr[] = [
                    'icon' => '<i class="zmdi zmdi-home"></i>',
                    'route' => 'app.dashboard',
                    'title' => 'Dashboard',
                ];

                $menuArr[] = [
                    'icon' => '<i class="material-icons">history</i>',
                    'route' => 'whatsapp.blasting.history',
                    'title' => 'Blasting History',
                ];
                 $menuArr[] = [
                    'icon' => '<i class="zmdi zmdi-whatsapp"></i>',
                    'route' => 'whatsapp.blasting',
                    'title' => 'WhatsApp Blasting',
                ];
                $menuArr[] = [
                    'icon' => '<i class="material-icons">message</i>',
                    'route' => 'message.templates',
                    'title' => 'Message Template',
                ];
                 $menuArr[] = [
                    'icon' => '<i class="material-icons">email</i>',
                    'route' => 'email.templates',
                    'title' => 'Email Template',
                ];
                $menuArr[] = [
                    'icon' => '<i class="material-icons">people</i>',
                    'route' => 'agent.landlord',
                    'title' => 'Landlords',
                ];
            
                $menuArr[] = [
                    'icon' => '<i class="material-icons">people</i>',
                    'route' => 'agent.tenants',
                    'title' => 'Tenants',
                ];
                
                $menuArr[] = [
                    'icon' => '<i class="material-icons">people</i>',
                    'route' => 'agent.rental.agreements',
                    'title' => 'Rental Agreements',
                ];
                $menuArr[] = [
                    'icon' => '<i class="material-icons">people</i>',
                    'route' => 'invoices.index',
                    'title' => 'Invoices',
                ];
                
                
//                $menuArr[] = [
//                    'icon' => '<i class="material-icons">account_circle</i>',
//                    'childs' => [['title' => 'List', 'route' => 'landlord.index'], ['title' => 'Add New', 'route' => 'landlord.add']],
//                    'title' => 'Landlord',
//                ];
//                $menuArr[] = [
//                    'icon' => '<i class="material-icons">face</i>',
//                    'childs' => [['title' => 'List', 'route' => 'tanent.index'], ['title' => 'Add New', 'route' => 'tanent.add']],
//                    'title' => 'Tenant',
//                ];
//                $menuArr[] = [
//                    'icon' => '<i class="material-icons">card_giftcard</i>',
//                    'childs' => [['title' => 'Exclude List', 'route' => 'message.exclude-list']],
//                    'title' => 'Birthday Reminder to Landlord & Tenant',
//                ];
//
//                $menuArr[] = [
//                    'icon' => '<i class="material-icons">account_balance_wallet</i>',
//                    'childs' => [['title' => 'List', 'route' => 'invoice.list'], ['title' => 'Add New', 'route' => 'tanent.add']],
//                    'title' => 'Invoice',
//                ];
//                $menuArr[] = [
//                    'icon' => '<i class="material-icons">gesture</i>',
//                    'childs' => [['title' => 'List', 'route' => 'agreement.index'], ['title' => 'Add New', 'route' => 'agreement.add']],
//                    'title' => 'Agreement',
//                ];
            }
            foreach ($menuArr as $k => $menu) {
                if ($menu['heading'] ?? '') {
                } elseif ($menu['childs'] ?? []) {
                    $menu['route'] = '';
                    $menu['active'] = $menu['active'] ?? '';
                    foreach ($menu['childs'] as $kC => $menuC) {
                        $menuC['active'] = routeActive($menuC['route']) ? 'active' : '';
                        if ($menuC['extra_routes'] ?? []) {
                            if (in_array(routeCurrName(), $menuC['extra_routes'])) {
                                $menuC['active'] = 'active';
                            }
                        }
                        if ($menuC['active']) {
                            $menu['active'] = 'active open';
                        }
                        $menu['childs'][$kC] = $menuC;
                    }
                } else {
                    $menu['active'] = routeActive($menu['route']) ? 'active' : '';
                    if ($menu['extra_routes'] ?? []) {
                        if (in_array(routeCurrName(), $menu['extra_routes'])) {
                            $menu['active'] = 'active';
                        }
                    }
                    $menu['childs'] = [];
                }
                $menuArr[$k] = $menu;
            }
            ?>
            <ul class="list">
                <?php foreach ($menuArr as $menu) { ?>
                <?php if ($menu['heading'] ?? '') { ?>
                <li class="header">{!! $menu['heading'] !!}</li>
                <?php } else { ?>
                <li class="{!! $menu['active'] !!}">
                    <a href="{!! $menu['childs'] ? 'javascript:void(0);' : routePut($menu['route'], $menu['args'] ?? []) !!}"
                        class="{!! $menu['childs'] ? 'menu-toggle' : '' !!}">{!! $menu['icon'] !!}
                        <span>{!! $menu['title'] !!}</span></a>
                    <?php if ($menu['childs']) { ?>
                    <ul class="ml-menu">
                        <?php foreach ($menu['childs'] as $kC => $menuChild) { ?>
                        <li class="{!! $menuChild['active'] !!}"><a href="{!! routePut($menuChild['route']) !!}">
                                {!! $menuChild['title'] !!}</a></li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#skins">Skins</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#chat">Chat</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings">Setting</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div><span>Red</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div><span>Purple</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div><span>Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div><span>Cyan</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div><span>Green</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div><span>Deep Orange</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div><span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div><span>Black</span>
                    </li>
                    <li data-theme="blush">
                        <div class="blush"></div><span>Blush</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane" id="chat">
                <div class="demo-settings">
                    <div class="search">
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" class="form-control" placeholder="Search..." required autofocus>
                            </div>
                        </div>
                    </div>
                    <h6>Recent</h6>
                    <ul>
                        <li class="online">
                            <div class="media">
                                <a href="javascript:void(0);"><img class="media-object "
                                        src="{!! pathAssets('images/xs/avatar1.jpg') !!}" alt=""></a>
                                <div class="media-body">
                                    <span class="name">Claire Sassu</span>
                                    <span class="message">Can you share the</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                        <li class="online">
                            <div class="media">
                                <a href="javascript:void(0);"><img class="media-object "
                                        src="{!! pathAssets('images/xs/avatar2.jpg') !!}" alt=""></a>
                                <div class="media-body">
                                    <span class="name">Maggie jackson</span>
                                    <span class="message">Can you share the</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                        <li class="online">
                            <div class="media">
                                <a href="javascript:void(0);"><img class="media-object "
                                        src="{!! pathAssets('images/xs/avatar3.jpg') !!}" alt=""></a>
                                <div class="media-body">
                                    <span class="name">Joel King</span>
                                    <span class="message">Ready for the meeti</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h6>Contacts</h6>
                    <ul class="contacts_list">
                        <li class="offline">
                            <div class="media">
                                <a href="javascript:void(0);"><img class="media-object "
                                        src="{!! pathAssets('images/xs/avatar4.jpg') !!}" alt=""></a>
                                <div class="media-body">
                                    <span class="name">Hossein Shams</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                        <li class="online">
                            <div class="media">
                                <a href="javascript:void(0);"><img class="media-object "
                                        src="{!! pathAssets('images/xs/avatar1.jpg') !!}" alt=""></a>
                                <div class="media-body">
                                    <span class="name">Maryam Amiri</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                        <li class="offline">
                            <div class="media">
                                <a href="javascript:void(0);"><img class="media-object "
                                        src="{!! pathAssets('images/xs/avatar2.jpg') !!}" alt=""></a>
                                <div class="media-body">
                                    <span class="name">Gary Camara</span>
                                    <span class="badge badge-outline status"></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
                <div class="demo-settings">
                    <p>General settings</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox">
                                    <span class="lever"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                    <p>System settings</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                    <p>Account settings</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox">
                                    <span class="lever"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" checked>
                                    <span class="lever"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</section>