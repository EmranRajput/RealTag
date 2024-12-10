<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('../build/images/logo-dark-sm.png')); ?>" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('../build/images/logo-dark.png')); ?>" alt="" height="28">
            </span>
        </a>

        <a href="index" class="logo logo-light">
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('../build/images/logo-light.png')); ?>" alt="" height="30">
            </span>
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('../build/images/logo-light-sm.png')); ?>" alt="" height="26">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="bx bx-menu align-middle"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <?php
            $menuArr = [];
            if (isAdmin()) {
                $menuArr[] = [
                    'icon' => '<i class="bx bx-home-alt icon nav-icon"></i>',
                    'route' => 'app.dashboard',
                    'title' => 'Dashboard',
                ];
                $menuArr[] = [
                    'icon' => '<i class="bx bx-group icon nav-icon"></i>',
                    'route' => 'add.agent',
                    'title' => 'Agents',
                ];
               
                $menuArr[] = [
                    'icon' => '<i class="bx bxs-file icon nav-icon"></i>',
                    'route' => 'user.agreements',
                    'title' => 'Agreements',
                ];
                $menuArr[] = [
                    'icon' => '<i class="bx bxs-cake icon nav-icon"></i>',
                    'route' => 'birthday.templates',
                    'title' => 'Birthday Templates ',
                ];
                $menuArr[] = [
                    'icon' => '<i class="bx bx-key icon nav-icon"></i>',
                    'route' => 'rental.templates',
                    'title' => 'Rental Templates ',
                ];

                $menuArr[] = [
                    'icon' => '<i class="bx bx-grid icon nav-icon"></i>',
                    'route' => 'whatsapp.instance.index',
                    'title' => 'Instances ',
                ];

                 $menuArr[] = [
                    'icon' => '<i class="bx bx-group icon nav-icon"></i>',
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
                    'icon' => '<i class="bx bx-home-alt icon nav-icon"></i>',
                    'route' => 'app.dashboard',
                    'title' => 'Dashboard',
                ];

                $menuArr[] = [
                    'icon' => '<i class="bx bx-history icon nav-icon"></i>',
                    'route' => 'whatsapp.blasting.history',
                    'title' => 'Blasting History',
                ];
                 $menuArr[] = [
                    'icon' => '<i class="bx bxl-whatsapp  icon nav-icon"></i>',
                    'route' => 'whatsapp.blasting',
                    'title' => 'WhatsApp Blasting',
                ];
                $menuArr[] = [
                    'icon' => '<i class="bx bx-message icon nav-icon"></i>',
                    'route' => 'message.templates',
                    'title' => 'Message Template',
                ];
                 $menuArr[] = [
                    'icon' => '<i class="bx bx-envelope  icon nav-icon"></i>',
                    'route' => 'email.templates',
                    'title' => 'Email Template',
                ];
                $menuArr[] = [
                    'icon' => '<i class="bx bx-group icon nav-icon"></i>',
                    'route' => 'agent.landlord',
                    'title' => 'Landlords',
                ];
            
                $menuArr[] = [
                    'icon' => '<i class="bx bx-group icon nav-icon"></i>',
                    'route' => 'agent.tenants',
                    'title' => 'Tenants',
                ];
                
                $menuArr[] = [
                    'icon' => '<i class="bx bxs-file-doc icon nav-icon"></i>',
                    'route' => 'agent.rental.agreements',
                    'title' => 'Rental Agreements',
                ];
                $menuArr[] = [
                    'icon' => '<i class="bx bx-receipt  icon nav-icon"></i>',
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
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <?php foreach ($menuArr as $menu) { ?>
                <?php if ($menu['heading'] ?? '') { ?>
                <li class="header"><?php echo $menu['heading']; ?></li>
                <?php } else { ?>
                <li class="<?php echo $menu['active']; ?>" data-key="t-menu">
                    <a href="<?php echo $menu['childs'] ? 'javascript:void(0);' : routePut($menu['route'], $menu['args'] ?? []); ?>"
                        class="<?php echo $menu['childs'] ? 'menu-toggle' : ''; ?>"><?php echo $menu['icon']; ?>

                        <span><?php echo $menu['title']; ?></span></a>
                    <?php if ($menu['childs']) { ?>
                    <ul class="ml-menu">
                        <?php foreach ($menu['childs'] as $kC => $menuChild) { ?>
                        <li class="<?php echo $menuChild['active']; ?>"><a href="<?php echo routePut($menuChild['route']); ?>">
                                <?php echo $menuChild['title']; ?></a></li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <?php } ?>
                <?php } ?>
                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End --><?php /**PATH E:\wamp\www\realtagportal\resources\views/layout/sidebar1.blade.php ENDPATH**/ ?>