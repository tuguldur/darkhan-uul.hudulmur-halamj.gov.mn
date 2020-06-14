<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>{{config('user_config.WEB_SITE_TITLE')}} - @yield('title')</title>

        @yield('facebook_og_tags')
        @yield('head')
    </head>

    <body>
        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div class="page-wrapper">
            @if (Session::has('form_success'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Мэдэгдэл!</strong> {!! Session::get('form_success') !!}
            </div>
            @endif

            @if (Session::has('form_fail'))
            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Мэдэгдэл!</strong> {!! Session::get('form_success') !!}
            </div>
            @endif

            <!-- Preloader -->
            <div class="preloader"></div>

            @yield('main_header')

            <!-- home page -->
            @yield('main_slider')

            @yield('main_services')

            @yield('front_about')

            @yield('sponsers')

            @yield('causes')

            @yield('call_action')

            @yield('volunteers')

            @yield('client_says')

            @yield('main_events')

            <!-- menu item -->
            @yield('page_info')

            @yield('page_title')

            @yield('page_container')

            @yield('main_footer')

        </div>
        <!--End pagewrapper-->

        @yield('javascript')
        @yield('user_javascript')

        @if (Session::has('contact_form_success'))
        <script type="text/javascript">
            $(function () {
                new PNotify({
                    title: 'Амжилттай',
                    text: 'Таны илгээсэн санал, хүсэлт, гомдлыг амжилттай хүлээн авлаа.',
                    type: 'success'
                });
            });
        </script>
        @endif
        @if (Session::has('contact_form_fail'))
        <script type="text/javascript">
            var backMessageToVisitor = "<?=Session::get('contact_form_fail');?>";
            $(function () {
                new PNotify({
                    title: 'Алдаа',
                    text: backMessageToVisitor
                });
            });
        </script>
        @endif
        
        @include('sections.sec_google_analytic', ['type' => config("user_config.ORG_INDEX")])
        
    </body>
</html>