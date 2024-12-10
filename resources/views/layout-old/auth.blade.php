<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{!! siteName($title ?? NULL) !!}</title>
  <link rel="icon" href="{{ pathPublic('favicon.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{!! pathAssets('plugins/bootstrap/css/bootstrap.min.css') !!}" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @stack('css')
  <!-- Custom Css -->
  <link rel="stylesheet" href="{!! pathAssets('css/main.css') !!}" />
  <link rel="stylesheet" href="{!! pathAssets('custom.css') !!}" />
  @stack('style')
</head>

<body class="theme-cyan authentication">
  @include('inc.loader')
  @yield('content')

{{--  <div class="theme-bg"></div>--}}

  <script>
    var msgSucc = "{{ session('success') ?: '' }}";
    var msgErr = "{{ session('error') ?: '' }}";
  </script>
  <!-- Jquery Core Js -->
  <?php
  $jsScripts = [
    'plugins/jquery/jquery-3.3.1.min.js',
    'plugins/bootstrap/js/bootstrap.bundle.min.js',
    'plugins/jquery-slimscroll/jquery.slimscroll.js',
    'plugins/node-waves/waves.js',
    // 'plugins/morphingsearch/morphingsearch.js',
    'plugins/jquery-validation/jquery.validate.js',
    'plugins/bootstrap-notify/bootstrap-notify.js',
    'js/admin.js',
    // 'js/morphing.js',
  ];
  foreach ($jsScripts as $jsScript) { ?>
    <script src="{!! pathAssets($jsScript) !!}"></script>
  <?php } ?>
  @stack('js')
  <script src="{!! pathAssets('custom.js') !!}"></script>
  @stack('script')
</body>

</html>
