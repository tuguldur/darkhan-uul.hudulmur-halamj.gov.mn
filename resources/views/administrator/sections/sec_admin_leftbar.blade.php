
@if ($type === '01')

<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{config('path_config.APP_PATH')}}/administrator" class="site_title"><img src="{{ asset(config('path_config.APP_PATH'). '/images/logo-symbol.png') }}" style="width:48px;" alt="Logo symbol" class="img-circle"> <span>XXҮГ</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset(config('path_config.APP_PATH'). '/uploads/user/avatars/default_female_600x600_avatar.png') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                @if (!Auth::guest())
                <span>Сайн байна уу,</span>
                <h2>{{ Auth::user()->name }}</h2>
                @endif
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Үндсэн цэсүүд</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Систем <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/administrator/menu/manager/">мэдээний цэс удирдах</a></li>
                            <li><a href="/administrator/menu/transfer">мэдээний цэс шилжүүлэх</a></li>
                            <li><a href="/administrator/menu/new/">шинэ цэс нэмэх</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-edit"></i> Мэдээ, Мэдээлэл <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/news/manager/">Мэдээ удирдах</a></li>
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/faq/manager/">Aсуулт - хариулт</a></li>
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/link/manager/">Холбоос удирдлага</a></li>
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/general-info/manager/">Ерөнхий мэдээлэл удирд-</a></li>
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/event/manager/">Үйл ажиллагаа улирдлага</a></li>
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/marquee/manager/">Гүйдэг зар удирдлага</a></li>
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/page/manager/">Хуудас удирдлага</a></li>
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/calendar-event/manager/">Календар үйл ажиллагаа</a></li>
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/complaint-request/manager/">Санал, гомдол, хүсэлт</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-edit"></i> Зураг, Дуу, Файл <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/file-upload/manager/">Файл хуулах</a></li>
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/gallery/manager/">Цомог удирдах</a></li>
                            <li><a href="{{config('path_config.APP_PATH')}}/administrator/gallery/images/manager/">Цомог зураг удирдах</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-edit"></i> Заавар, зөвлөгөө <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/administrator/guide/news_manager/">Мэдээ удирдах зөвлөгөө</a></li>
                            <li><a href="/administrator/guide/event_manager/">Үйл ажиллагаа зөвлөгөө</a></li>
                            <li><a href="/administrator/guide/link_manager/">Холбоос удирдах зөвлөгөө</a></li>
                            <li><a href="/administrator/guide/general_info_manager/">Ерөнхий мэдээлэл засах</a></li>
                            <li><a href="/administrator/guide/marquee_info_manager/">Гүйдэг зар удирдах зөвлөгөө</a></li>
                            <li><a href="/administrator/guide/edit_old_news_manager/">Хуучин мэдээ засварлах</a></li>
                            <li><a href="/administrator/guide/edit_image_resize/">Зургийн хэмжээ өөрчлөх</a></li>
                            <li><a href="/administrator/guide/edit_none_responsive_image/">Мэдээний зургийн гажилт засах</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
        
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

@elseif ($type === '02')

Include section 02

@else

Include section anything

@endif