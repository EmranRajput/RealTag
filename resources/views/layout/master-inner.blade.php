<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title> @yield('title') | RealTeg</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('../build/images/favicon.ico') }}">

    
    <link href="{{ URL::asset('../build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('../build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('../build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    
</head>

@yield('body')

<!-- Begin page -->
<div id="layout-wrapper">
    <!-- topbar -->
    @include('layout.topbar1')

    <!-- sidebar components -->
    @include('layout.sidebar1')
    @include('layout.horizontal1')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- footer -->
        @include('layout.footer1')

    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- customizer -->
<!--@include('layout.right-sidebar1')-->

<!-- vendor-scripts -->
@include('layout.vendor-scripts1')

</body>

</html>
