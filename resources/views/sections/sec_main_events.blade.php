
@if ($type === '01')

<!--Default Section-->
<section class="default-section">
    <div class="auto-container">
        <div class="row clearfix page-part-style" style="background: #fff;margin: auto 0;padding-top:10px;border-bottom: 1px solid #ccc;">
            <!--News Column-->
            <div class="news-column col-md-6 col-sm-12 col-xs-12">
                <!--Sec Title-->
                <div class="sec-title">
                    <h3>мэдээлэл</h3>
                </div>

                <div class="news-style-one">
                    <div class="inner-box">
                        
                            <!-- Responsive calendar - START -->
                            <div class="responsive-calendar">
                                <div class="controls">
                                    <a class="pull-left" data-go="prev"><div class="btn btn-primary">өмнөх</div></a>
                                    <h4><span data-head-year></span> <span data-head-month></span></h4>
                                    <a class="pull-right" data-go="next"><div class="btn btn-primary">дараах</div></a>
                                </div><hr/>
                                <div class="day-headers">
                                    <div class="day header">даваа</div>
                                    <div class="day header">мягмар</div>
                                    <div class="day header">лхагва</div>
                                    <div class="day header">пүрэв</div>
                                    <div class="day header">баасан</div>
                                    <div class="day header">бямба</div>
                                    <div class="day header">ням</div>
                                </div>
                                <div class="days" data-group="days">

                                </div>
                            </div>
                            <!-- Responsive calendar - END -->
                       



                        <!--
                        <div class="image">
                            <a href="blog-single.html"><img src="http://t.commonsupport.com/salonika/images/resource/news-1.jpg" alt="" /></a>
                            <div class="news-icon">
                                <span class="icon fa fa-video-camera"></span>
                            </div>
                        </div>
                        <div class="lower-content">
                            <div class="post-date">January 27, 2017</div>
                            <h3><a href="blog-single.html">Deluxe apartment in the sky</a></h3>
                            <div class="text">One day when the lady met this fellows and they knew it was much to more than world full of been wonder flying.</div>
                        </div>
                        -->
                    </div>
                </div>

            </div>
            <!--Event Column-->
            <div class="event-column col-md-6 col-sm-12 col-xs-12">
                <!--Sec Title-->
                <div class="sec-title">
                    <h3>үйл ажиллагаа</h3>
                </div>

                {!! printLastThreeEvents() !!}

                <!--
                <div class="event-block">
                    <div class="inner-box">
                        <div class="content">
                            <div class="date-box">
                                18 <span>january</span>
                            </div>
                            <h3><a href="event-single.html">The powerless in a world of criminals who operate above the law</a></h3>
                            <ul class="event-info">
                                <li><span class="icon fa fa-clock-o"></span>8.00am to 7.00pm</li>
                                <li><span class="icon fa fa-map-marker"></span>Skozlovia, South Africa</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="event-block">
                    <div class="inner-box">
                        <div class="content">
                            <div class="date-box">
                                06 <span>february</span>
                            </div>
                            <h3><a href="event-single.html">The ship set ground on the shore of this uncharted desert isle</a></h3>
                            <ul class="event-info">
                                <li><span class="icon fa fa-clock-o"></span>8.00am to 7.00pm</li>
                                <li><span class="icon fa fa-map-marker"></span>Skozlovia, South Africa</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="event-block">
                    <div class="inner-box">
                        <div class="content">
                            <div class="date-box">
                                24 <span>March</span>
                            </div>
                            <h3><a href="event-single.html">Powerless in a world of criminals who operate  with Gilligan</a></h3>
                            <ul class="event-info">
                                <li><span class="icon fa fa-clock-o"></span>8.00am to 7.00pm</li>
                                <li><span class="icon fa fa-map-marker"></span>Skozlovia, South Africa</li>
                            </ul>
                        </div>
                    </div>
                </div>
                -->

            </div>
        </div>
    </div>
</section>
<!--End Default Section-->

@elseif ($type === '02')


@else

Include section anything

@endif