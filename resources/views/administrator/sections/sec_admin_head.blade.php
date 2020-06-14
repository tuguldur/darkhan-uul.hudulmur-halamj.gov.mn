
@if ($type === '01')

<!-- Bootstrap -->
<link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- NProgress -->
<link href="{{ asset('assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
<!-- iCheck -->
<link href="{{ asset('assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

<!-- bootstrap-progressbar -->
<link href="{{ asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
<!-- JQVMap -->
<link href="{{ asset('assets/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

<link href="{{ asset('plugins/jquery-ui-1.12.1/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('plugins/jquery-ui-1.12.1/jquery-ui.theme.min.css') }}" rel="stylesheet" type="text/css"/>

<!-- JS Tree https://www.jstree.com/ -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

<!-- Custom Theme Style -->
<link href="{{ asset('assets/build/css/custom.min.css') }}" rel="stylesheet">

<link href="{{ asset('css/redefined_style_admin.css') }}" rel="stylesheet">

@elseif ($type === '02')

Include section 02

@else

Include section anything

@endif