
@if ($type === '01')

<!-- Main Header-->
<header class="main-header">

    <!--Header Top-->
    {!! printHeaderMarqueeText() !!}

    <!--Header-Upper-->
    <div class="header-upper">
        <div class="auto-container">
            <div class="clearfix">

                <div class="pull-left logo-outer">
                    <div class="logo"><a href="/"><img src="{{ asset(config('path_config.APP_PATH'). '/images/logo.png') }}" alt="" title=""></a></div>
                </div>


                <div class="pull-right upper-right clearfix">

                    <!--
                    <div class="upper-column info-box">
                        <div class="icon-box"><span class="flaticon-house-outline"></span></div>
                        <ul>
                            <li><strong>13AH, Crooswood St,</strong></li>
                            <li>Colorado, United States.</li>
                        </ul>
                    </div>

                    <div class="upper-column info-box">
                        <div class="icon-box"><span class="flaticon-web"></span></div>
                        <ul>
                            <li><strong>Send mail at</strong></li>
                            <li>salonika@charity.com</li>
                        </ul>
                    </div>
                    -->

                    <div class="upper-column info-box">
                        <!-- <div class="icon-box"><span class="flaticon-search"></span></div> -->
                        <form method="post" action="/search" onsubmit="return validateSearchForm(this);">
                            <div class="form-group">
                                <input name="searchText" id="searchTextInputId" value="" placeholder="Хайлт..." type="search" maxlength="50" />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit"><span class="icon fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <!--End Header Upper-->

    <!--Header Lower-->
    <div class="header-lower">

        <div class="auto-container">
            <div class="nav-outer clearfix">
                <!-- Main Menu -->
                <nav class="main-menu">
                    <div class="navbar-header">
                        <!-- Toggle Button -->    	
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="navbar-collapse collapse clearfix">
                        {!! printHomeHeaderMenuTree() !!}
                        <!--
                        <ul class="navigation clearfix">
                            <li><a href="about.html">Нүүр хуудас</a></li>
                            <li class="current dropdown"><a href="#">Бидний тухай</a>
                                <ul>
                                    <li><a href="index.html">Homepage One</a></li>
                                    <li><a href="index-2.html">Homepage Two</a></li>
                                    <li class="dropdown"><a href="#">Header Styles</a>
                                        <ul>
                                            <li><a href="index.html">Header Style One</a></li>
                                            <li><a href="index-2.html">Header Style Two</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="about.html">Халамжийн үйлчилгээ</a></li>
                            <li class="dropdown"><a href="#">Мэдээлэл</a>
                                <ul>
                                    <li><a href="causes.html">Causes</a></li>
                                    <li><a href="causes-single.html">Causes Single</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Ил тод байдал</a>
                                <ul>
                                    <li><a href="events.html">Events</a></li>
                                    <li><a href="event-single.html">Event Single</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Хөдөлмөр</a>
                                <ul>
                                    <li><a href="gallery.html">Gallery</a></li>
                                    <li><a href="gallery-masonry.html">Gallery Masonry</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Шилэн данс</a>
                                <ul>
                                    <li><a href="blog.html">Our Blog</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                        -->
                    </div>
                </nav>

                <!-- Main Menu End-->
                <!--
                <div class="btn-box">
                    <a href="donate.html" class="donate-btn theme-btn">Donate Now</a>
                </div>
                -->
            </div>
        </div>
    </div>
    <!--End Header Lower-->

    <!--Sticky Header-->
    <div class="sticky-header">
        <div class="auto-container clearfix">
            <!--Logo-->
            <div class="logo pull-left">
                <a href="/" class="img-responsive"><img src="{{ asset(config('path_config.APP_PATH') . '/images/logo.png') }}" alt="" title="" style="width: 100px;"></a>
            </div>

            <!--Right Col-->
            <div class="right-col pull-right">
                <!-- Main Menu -->
                <nav class="main-menu">
                    <div class="navbar-header">
                        <!-- Toggle Button -->    	
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="navbar-collapse collapse clearfix">
                        <ul class="navigation clearfix">
                            <li class="current"><a href="{{asset('/')}}">Нүүр хуудас</a>
                                <!--
                                <ul>
                                    <li><a href="index.html">Homepage One</a></li>
                                    <li><a href="index-2.html">Homepage Two</a></li>
                                    <li class="dropdown"><a href="#">Header Styles</a>
                                        <ul>
                                            <li><a href="index.html">Header Style One</a></li>
                                            <li><a href="index-2.html">Header Style Two</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                -->
                            </li>
                            <!--
                            <li><a href="about.html">About</a></li>
                            <li class="dropdown"><a href="#">Causes</a>
                                <ul>
                                    <li><a href="causes.html">Causes</a></li>
                                    <li><a href="causes-single.html">Causes Single</a></li>
                                </ul>
                            </li>
                            -->
                            <li><a href="{{asset('/events/')}}">Үйл ажиллагаа</a>
                                <!--
                                <ul>
                                    <li><a href="events.html">Events</a></li>
                                    <li><a href="event-single.html">Event Single</a></li>
                                </ul>
                                -->
                            </li>
                            <!--
                            <li class="dropdown"><a href="#">Gallery</a>
                                <ul>
                                    <li><a href="gallery.html">Gallery</a></li>
                                    <li><a href="gallery-masonry.html">Gallery Masonry</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Blog</a>
                                <ul>
                                    <li><a href="blog.html">Our Blog</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            -->
                            <li><a href="{{asset('/contact/')}}">Холбоо барих</a></li>
                        </ul>
                    </div>
                </nav><!-- Main Menu End-->
            </div>

        </div>
    </div>
    <!--End Sticky Header-->

</header>
<!--End Main Header -->

@elseif ($type === '02')

Include section 02

@else

Include section anything

@endif