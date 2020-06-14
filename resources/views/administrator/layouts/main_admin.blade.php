@if (Auth::guest())
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ХХҮГ веб хуудас удирдлага - Нэвтрэх</title>

    </head>

    <body>

        <h4>Энэ хуудсанд хандах эрхгүй байна!. <a href="{{ route('login') }}">Login</a></h4>

    </body>
</html>

@else 

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ХХҮГ веб хуудас удирдлага - @yield('admin_title')</title>

        @yield('admin_head')

    </head>

    <body class="nav-md">
        
        <div class="container body">
            <div class="main_container">
                <!-- Authentication Links -->

                @yield('admin_leftbar')

                @yield('admin_topbar')

                @yield('admin_rightbar')

                @yield('admin_footer')

            </div>
        </div>

        @yield('admin_javascript')

        @yield('admin_user_javascript')

    </body>
</html>
@endif