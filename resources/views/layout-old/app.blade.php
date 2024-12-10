<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{!! siteName($title ?? null) !!}</title>
    <link rel="icon" href="{!! pathPublic('favicon.ico') !!}" type="image/x-icon">
    <link rel="stylesheet" href="{!! pathAssets('plugins/bootstrap/css/bootstrap.min.css') !!}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{!! pathAssets('plugins/morrisjs/morris.css') !!}" />
    <link href="{!! pathAssets('plugins/jquery-datatable/dataTables.bootstrap4.min.css') !!}" rel="stylesheet">
    <link rel="stylesheet" href="{!! pathAssets('plugins/dropzone/dropzone.css') !!}"><!-- Dropzone Css -->
    <link rel="stylesheet"
        href="{!! pathAssets('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') !!}" />
    <!-- Bootstrap Material Datetime Picker Css -->
    <link rel="stylesheet" href="{!! pathAssets('plugins/waitme/waitMe.css') !!}" /><!-- Wait Me Css -->
    <link rel="stylesheet" href="{!! pathAssets('plugins/bootstrap-select/css/bootstrap-select.css') !!}" />
    <!-- Bootstrap Select Css -->
    <link rel="stylesheet" href="{!! pathAssets('plugins/select2/select2.min.css') !!}" /><!-- Bootstrap Select Css -->
    <link rel="stylesheet" href="{!! pathAssets('plugins/sweetalert/sweetalert.css') !!}" />
    <link rel="stylesheet" href="{!! pathAssets('plugins/summernote/summernote-bs4.css') !!}">
    <link rel="stylesheet" href="{!! pathAssets('plugins/font-awesome/css/all.min.css') !!}">
    <link rel="stylesheet" href="{!! pathAssets('plugins/jquery-ui/css/jquery-ui.css') !!}"><!-- New DateTime Picker -->
    <link rel="stylesheet" href="{!! pathAssets('plugins/morrisjs/morris.css') !!}"><!-- Morris Search -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @stack('css')
    <link rel="stylesheet" href="{!! pathAssets('css/main.css') !!}" /><!-- Custom Css -->
    <link rel="stylesheet" href="{!! pathAssets('custom.css') !!}" /><!-- Custom Css -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
          <link rel="stylesheet" href="https://unpkg.com/jodit@4.0.0-beta.24/es2021/jodit.min.css">
          <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    @stack('style')
</head>

<body class="theme-cyan">
    @include('inc.loader')
    @include('inc.main-search')
    @include('inc.top-bar')
    @include('inc.sidebars')
    {{-- <div class="main-title">
        <h6>{{ logRehabName() }}</h6>
    </div> --}}
    @yield('content')

    <div class="color-bg"></div>

    @stack('modals')
    <script>
    var msgSucc = "{{ session('success') ?: '' }}";
    var msgErr = "{{ session('error') ?: '' }}";
    </script>
    <!-- Jquery Core Js -->
    <?php
  $jsScripts = [
    // libscripts.bundle.js
    'plugins/jquery/jquery-3.3.1.min.js',
    'plugins/bootstrap/js/bootstrap.bundle.min.js',

    // vendorscripts.bundle.js
    'plugins/jquery-slimscroll/jquery.slimscroll.js',
    'plugins/node-waves/waves.js',
    'plugins/morphingsearch/morphingsearch.js',

    // datatablescripts.bundle.js
    'plugins/jquery-datatable/jquery.dataTables.min.js',
    'plugins/jquery-datatable/dataTables.bootstrap4.min.js',

    'plugins/jquery-validation/jquery.validate.js',
    'plugins/bootstrap-notify/bootstrap-notify.js',
    'plugins/autosize/autosize.js', // Autosize Plugin Js
    'plugins/momentjs/moment.js', // Moment Plugin Js
    'plugins/dropzone/dropzone.js', // Dropzone Plugin Js
    'plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js', // Bootstrap Material Datetime Picker Plugin Js
    'plugins/jquery-ui/js/jquery-ui.min.js',// New DateTime Picker

    'plugins/select2/select2.min.js',
    'plugins/sweetalert/sweetalert.min.js',
    'plugins/summernote/summernote-bs4.min.js',
    'plugins/font-awesome/js/all.min.js',

    'js/admin.js',
    'js/morphing.js',
    //  data table
    
  ];
  foreach ($jsScripts as $jsScript) { ?>
    <script src="{!! pathAssets($jsScript) !!}"></script>
    <?php } ?>
    @stack('js')
    <script src="{!! pathAssets('custom.js') !!}"></script>
    @stack('script')
</body>

</html>