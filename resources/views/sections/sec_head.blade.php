
@if ($type === '01')
<!-- Stylesheets -->
<link href="{{ asset(config('path_config.APP_PATH'). 'css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset(config('path_config.APP_PATH'). 'css/revolution-slider.css') }}" rel="stylesheet">

<link href="{{ asset(config('path_config.APP_PATH'). 'css/pgwslider.min.css') }}" rel="stylesheet">
<link href="{{ asset(config('path_config.APP_PATH'). 'css/responsive-calendar.css') }}" rel="stylesheet">
<link href="{{ asset(config('path_config.APP_PATH'). 'css/style.css') }}" rel="stylesheet">
<link href="{{ asset('/plugins/ammap/ammap.css') }}" rel="stylesheet">

<!--Favicon-->
<link rel="shortcut icon" href="{{ asset(config('path_config.APP_PATH'). 'images/favicon.ico') }}" type="image/x-icon">

<!-- Responsive -->
<link href="{{ asset(config('path_config.APP_PATH'). 'css/responsive.css') }}" rel="stylesheet">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->

<link href="{{ asset(config('path_config.APP_PATH'). 'css/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
<link href="{{ asset('/css/pnotify.custom.min.css') }}" rel="stylesheet">

<link href="{{ asset(config('path_config.APP_PATH'). 'css/redefined_style.css') }}" rel="stylesheet">
<link href="{{ asset(config('path_config.APP_PATH'). 'css/job_map_style.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css" />
@elseif ($type === '02')


@else

Include section anything

@endif