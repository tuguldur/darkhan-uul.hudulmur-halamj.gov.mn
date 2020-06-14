
@if ($type === '01')
<div class="sidebar-page-container blog-page">
    <div class="auto-container">
        <div class="row clearfix page-part-style" style="background: #fff;margin-left: 0px;margin-right: 0px;padding-top: 30px;">

            <!--Content Side-->
            <div class="content-side col-lg-9 col-md-8 col-sm-12 col-xs-12">
                @if ($page_type == 'many_items')
                <!--Our Blog-->
                <section class="our-blog">
                    {!! printMenuItems($menuID, $pageIndex) !!}

                    <!--News Style One-->
                    <!--
                    <div class="news-style-one">
                        <div class="inner-box">
                            <div class="image">
                                <a href="blog-single.html"><img src="images/resource/news-3.jpg" alt=""></a>
                                <div class="news-icon">
                                    <span class="icon fa fa-image"></span>
                                </div>
                            </div>
                            <div class="lower-content">
                                <div class="post-date">January 27, 2017</div>
                                <h3><a href="blog-single.html">Deluxe apartment in the sky</a></h3>
                                <div class="text">These days are all share them with me oh baby said inspet Californy till the one day when the lady met this feels lows and they knew it was much more than a hunch and when the odds racer.</div>
                            </div>
                        </div>
                    </div>
                    -->

                </section>

                <!-- Styled Pagination -->
                <!--
                <div class="styled-pagination text-right">
                    <ul class="clearfix">
                        <li><a class="prev" href="#"><span class="fa fa-angle-double-left"></span></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#" class="active">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a class="next" href="#"><span class="fa fa-angle-double-right"></span></a></li>
                    </ul>
                </div>
                -->
                @elseif ($page_type === 'active_jobs_list')
                
                <h3 class="job-page-title"> {{$activeJobZoneName or ''}} нээлтэй ажлын байрны жагсаалт</h3>
                <div role="tabpanel" class="tab-pane fade in active" id="popular-jobs">
                    @foreach ($arrayActiveJobs as $key => $arrayActiveJob)
                    <?php
                    /*
                     * http://wrapbootstrap.com/preview/WB054R5R0
                     */
                    ?>
                    <div class="job-ad-item">
                        <div class="item-info">
                            <div class="row">
                                <div class="col-xs-6 col-sm-2 col-md-2 col-lg-2">
                                    <div class="item-image-box">
                                        <div class="item-image">
                                            <img src="{{asset('/images/no-image-for-job-logo.png')}}" alt="Image" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-10 col-md-10 col-lg-10">
                                    <div class="ad-info">
                                        <span><a class="title">{{$arrayActiveJob->jobName}}</a> | <a >{{$arrayActiveJob->jobEmployer2->empName}}</a></span>
                                        <div class="ad-meta">
                                            <ul>
                                                <li title="Ажлын байрны байрлал"><i class="fa fa-map-marker" aria-hidden="true" style="color:#EB4336;"></i>{{$arrayActiveJob->jobAimNiis->nameAN}}, {{$arrayActiveJob->jobSumDuureg->sumDuuregName}}</li>
                                                <li title="Ажлын байрны хүчинтэй зарлагдах хугацаа"><i class="fa fa-clock-o" aria-hidden="true" style="color: #90CC61;"></i>{{date("Y-m-d", strtotime($arrayActiveJob->jobValidDate))}}</li>
                                                <li title="Ажлын байрны цалингийн хэмжээ"><i class="fa fa-money" aria-hidden="true" style="color:#4075B4;"></i>{{$arrayActiveJob->minSalary}}₮ - {{$arrayActiveJob->maxSalary}}₮</li>
                                                <li><a href="/view/sector/active-jobs/{{$arrayActiveJob->jobGeneralType->id or '10020'}}"><i class="fa fa-tags" aria-hidden="true" style="color:#3DA3B7;"></i>{{$arrayActiveJob->jobGeneralType->name}}</a></li>
                                            </ul>
                                        </div>							
                                    </div>
                                </div>
                            </div>
                            <div class="button">
                                <a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal{{$key}}">нэмэлт мэдээлэл</a>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade job-detail-modal" id="myModal{{$key}}" role="dialog">
                            <div class="modal-dialog active-job-modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">{{$arrayActiveJob->jobName}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- <p>This is a large modal.</p> -->
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Нэршил</th>
                                                    <th>Утга</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><i class="fa fa-user-circle" aria-hidden="true" style="color:#2C6088;"></i></td>
                                                    <td><strong>Зарласан ажлын байр:</strong></td>
                                                    <td>{{$arrayActiveJob->jobName or ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-handshake-o" aria-hidden="true" style="color:#2C6088;"></i></td>
                                                    <td><strong>Ажлын байрны гүйцэтгэх үүрэг:</strong></td>
                                                    <td>{{$arrayActiveJob->jobResponsibility or ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-clock-o" aria-hidden="true" style="color: #90CC61;"></i></td>
                                                    <td><strong>Зарладсан огноо:</strong></td>
                                                    <td>{{date("Y-m-d", strtotime($arrayActiveJob->jobAnnouncedDate))}}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-clock-o" aria-hidden="true" style="color: #90CC61;"></i></td>
                                                    <td><strong>Хаагдах огноо:</strong></td>
                                                    <td>{{date("Y-m-d", strtotime($arrayActiveJob->jobValidDate))}}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-money" aria-hidden="true" style="color:#4075B4;"></i></td>
                                                    <td><strong>Ажлын байрны цалин:</strong></td>
                                                    <td>{{$arrayActiveJob->minSalary or ''}}₮ - {{$arrayActiveJob->maxSalary or ''}}₮</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-tags" aria-hidden="true" style="color:#3DA3B7;"></i></td>
                                                    <td><strong>Ажлын байрны чиглэл:</strong></td>
                                                    <td>{{$arrayActiveJob->jobGeneralType->name or ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-id-card" aria-hidden="true" style="color:#2C6088;"></i></td>
                                                    <td><strong>Ажлын байрыг зарлагч:</strong></td>
                                                    <td>{{$arrayActiveJob->jobEmployer2->empName or ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-building" aria-hidden="true" style="color:#2C6088;"></i></td>
                                                    <td><strong>Аж ахуй нэгж төрөл:</strong></td>
                                                    <td>@if ($arrayActiveJob->jobEmployer2->empType === "1")
                                                        компани
                                                        @elseif ($arrayActiveJob->jobEmployer2->empType === "0")
                                                        иргэн
                                                        @else
                                                        доторхойгүй
                                                        @endif</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-map-marker" aria-hidden="true" style="color:#EB4336;"></i></td>
                                                    <td><strong> Ажлын байрны байрлал:</strong></td>
                                                    <td>{{$arrayActiveJob->jobAimNiis->nameAN or ''}}, {{$arrayActiveJob->jobSumDuureg->sumDuuregName or ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-phone-square" aria-hidden="true" style="color: #80DDFF;"></i></td>
                                                    <td><strong> Холбоо барих утас-1:</strong></td>
                                                    <td>{{$arrayActiveJob->jobEmployer2->empAddr->mobilePhone1 or ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-phone-square" aria-hidden="true" style="color: #80DDFF;"></i></td>
                                                    <td><strong> Холбоо барих утас-2:</strong></td>
                                                    <td>{{$arrayActiveJob->jobEmployer2->empAddr->mobilePhone2 or ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fa fa-envelope" aria-hidden="true" style="color: #90CC61;"></i></td>
                                                    <td><strong> Холбоо барих цахим шуудан:</strong></td>
                                                    <td>{{$arrayActiveJob->jobEmployer2->empAddr->email or ''}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Хаах</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @elseif ($page_type === 'search_found_items')

                <section class="our-blog">
                   
                    
                    {!! $backData !!}
                </section>

                <!--
                <div class="styled-pagination text-right">
                    <ul class="clearfix">
                        <li><a class="prev" href="#"><span class="fa fa-angle-double-left"></span></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#" class="active">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a class="next" href="#"><span class="fa fa-angle-double-right"></span></a></li>
                    </ul>
                </div>
                -->

                @elseif ($page_type === 'contact_organization')

                <section class="events-single">
                    <div class="basic-info">
                        <div class="inner-box">
                            <div class="image">
                                <img src="/images/resources/office-picture.jpg" alt="">
                            </div>
                            <div class="lower-content">
                                <div class="upper-box">
                                    <div class="row clearfix">
                                        <div class="column col-md-8 col-sm-12 col-xs-12">
                                            <!--Event Block-->
                                            <div class="event-block">
                                                <div class="inner-box">
                                                    <div class="logo-box">
                                                        <img src="{{asset('/images/logo-symbol.png')}}" />
                                                    </div>
                                                    <h3>{{config('user_config.ORG_MAIN_NAME')}}</h3>
                                                    <ul class="event-info">
                                                        <li><span class="icon fa fa-clock-o"></span>{{config('user_config.ORG_WORKING_HOURS')}}</li>
                                                        <li><span class="icon fa fa-map-marker"></span>{{config('user_config.ORG_ADDRESS')}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="social-column col-md-4 col-sm-12 col-xs-12">
                                            <ul class="social-icon-three">
                                                <li><strong>Нийтийн сүлжээ:</strong></li>
                                                <li><a href="{{config('user_config.ORG_SOCIAL_LINKS.fa-facebook')}}" target="_blank"><span class="fa fa-facebook"></span></a></li>
                                                <!--<li><a href="#"><span class="fa fa-twitter"></span></a></li>-->
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="more-info">
                        <div class="text">
                            <p></p>
                            <!--
                            <table style="width:100%">
                                <caption>Албан хаагчидтай ажлын цагаар холбогдох утасны дугаарууд</caption>
                                <tr>
                                    <th>Ажлын байрны нэр</th>
                                    <th>Албан хаагчийн нэр</th>
                                    <th>Холбогдож утас</th>
                                </tr>
                                <tr>
                                    <td>Мэргэжилтэн</td>
                                    <td>Болд</td>
                                    <td>70401232</td>
                                </tr>
                                <tr>
                                    <td>Цахилгаанчин</td>
                                    <td>Сандаг</td>
                                    <td>70401232</td>
                                </tr>
                            </table> 
                            -->
                        </div>
                        <iframe
                            width="100%"
                            height="450"
                            frameborder="0" style="border:0"
                            src="https://www.google.com/maps/embed/v1/view?key=AIzaSyACBzbDWz7igVl33PXLeSlZkPbfT8EnzPc
                            &center={{config('user_config.ORG_GOOGLE_MAP_COORDINATE')}}" allowfullscreen>
                        </iframe>
                    </div>

                    <div class="info-boxed">
                        <h3>холбоо барих</h3>
                        <div class="row clearfix">
                            <!--Info Block-->
                            <div class="info-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="inner-box">
                                    <div class="icon-box"><span class="flaticon-home-1"></span></div>
                                    <div class="text">{{config('user_config.ORG_ADDRESS')}}</div>
                                </div>
                            </div>
                            <!--Info Block-->
                            <div class="info-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="inner-box">
                                    <div class="icon-box"><span class="flaticon-technology-4"></span></div>
                                    <div class="text">
                                        @foreach (config('user_config.ORG_PHONES') as $key => $value)  
                                        {{ $value }} <br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--Info Block-->
                            <div class="info-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="inner-box">
                                    <div class="icon-box"><span class="flaticon-envelope-1"></span></div>
                                    <div class="text">
                                        @foreach (config('user_config.ORG_EMAILS') as $key => $value)  
                                        <a href="mailto:{{ $value }}">{{ $value }}</a> <br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                @elseif ($page_type === 'single_item')

                <section class="blog-single">

                    <!--News Style One-->

                    {!! printMenuItemPost(Request::path()) !!}

                    <!--
                    <div class="news-style-one">
                        <div class="inner-box">
                            <div class="image">
                                <img src="images/resource/news-4.jpg" alt="">
                                <div class="news-icon">
                                    <span class="icon fa fa-video-camera"></span>
                                </div>
                            </div>
                            <div class="lower-content">
                                <div class="post-date">February 06, 2017</div>
                                <h3>Trouble with the law since the day</h3>
                                <div class="text">
                                    <p>One day when the lady met this fellows and they knew it was much more than a hunch and when the odds and we know Flipper lives in a world full of been wonder flying there-under under the sea the movie star the professor and Mary Ann here on Gilligans Isle and when the odds are against him and their dangers work to do you bet your life Speed Racer he will see it through these to days are all Happy and Free these days are all share them with me oh baby.</p>
                                    <p>These days are all share them with me oh baby said inspet Californy till the one day when the lady met this feels lows and they knew it was much more than a hunch and when the odds racer are all share them with me oh baby said inspet Californy till the one day when the lady met this feels lows and they knew it was much more than a hunch and when the odds racer.</p>
                                    <blockquote>
                                        <div class="icon-box">
                                            <span class="icon flaticon-left-quote-1"></span>
                                        </div>
                                        <div class="text">The lady met this fellows and they knew it was much more than a hunch and when the odds and we know Flipper lives in a world full of been wonder.</div>
                                        <span class="author-name">- Flechars Phonix -</span>
                                    </blockquote>
                                    <p>The lady met this fellows and they knew it was much more than a hunch and when the odds and we know Flipper lives in a world full of been wonder flying there-under under the sea the movie star the professor and Mary Ann here on Gilligans Isle and when the odds are against him and their dangers work to do you bet your life Speed Racer he will see it through these to days.</p>
                                    <p>All share them with me oh baby said inspet Californy till the one day when the lady met this feels lows and they knew it was much more than a hunch and when the odds racer are all share them with me oh baby said inspet Californy till the one day when to be continued with the lady met this feels lows.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                    <!--New Posts-->
                    <div class="new-posts">
                        <div class="clearfix">
                            <!--
                            <div class="pull-left">
                                <a href="#"><span class="icon fa fa-angle-double-left"></span>&nbsp; өмнөх мэдээлэл</a>
                            </div>
                            <div class="pull-right">
                                <a href="#">дараагийн мэдээлэл &nbsp;<span class="icon fa fa-angle-double-right"></span></a>
                            </div>
                            -->
                            <!--social links three-->
                            <ul class="social-icon-three">
                                <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                                <li><a href="#"><span class="fa fa-print"></span></a></li>
                                <li><a href="#"><span class="fa fa-envelope"></span></a></li>
                            </ul>
                        </div>
                    </div>

                    <!--Related Posts-->
                    <!--
                    <div class="related-posts">
                        <div class="sec-title">
                            <h2>Хамааралтай мэдээнүүд</h2>
                        </div>
                        <div class="row clearfix">

                            <div class="news-style-one col-md-6 col-sm-6 col-xs-12">
                                <div class="inner-box">
                                    <div class="image">
                                        <a href="blog-single.html"><img src="images/resource/news-8.jpg" alt=""></a>
                                        <div class="news-icon">
                                            <span class="icon fa fa-video-camera"></span>
                                        </div>
                                    </div>
                                    <div class="lower-content">
                                        <div class="post-date">January 27, 2017</div>
                                        <h3><a href="blog-single.html">Deluxe apartment in the sky</a></h3>
                                        <div class="text">One day when the lady met this fellows and they knew it was much to more than world full of been wonder flying.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="news-style-one col-md-6 col-sm-6 col-xs-12">
                                <div class="inner-box">
                                    <div class="image">
                                        <a href="blog-single.html"><img src="images/resource/news-9.jpg" alt=""></a>
                                        <div class="news-icon">
                                            <span class="icon fa fa-video-camera"></span>
                                        </div>
                                    </div>
                                    <div class="lower-content">
                                        <div class="post-date">January 27, 2017</div>
                                        <h3><a href="blog-single.html">Fleeing from the Cylon tyranny</a></h3>
                                        <div class="text">One day when the lady met this fellows and they knew it was much to more than world full of been wonder flying.</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    -->

                    <!--Comments Area-->
                    <!--
                    <div class="comments-area">
                        <div class="group-title"><h2>Comments (03)</h2></div>

                        <div class="comment-box">
                            <div class="comment">
                                <div class="author-thumb"><img src="images/resource/author-1.jpg" alt=""></div>
                                <div class="comment-inner">
                                    <div class="comment-info clearfix"><strong>Maxwell</strong></div>
                                    <div class="comment-date">January 29, 2017</div>
                                    <div class="text">The lady met this fellows and they knew it was much more than a hunch and when the odds and we know Flipper lives in a world full of been wonder flying</div>
                                    <a class="comment-reply" href="#">Reply <span class="fa fa-mail-forward"></span></a>
                                </div>
                            </div>
                        </div>

                        <div class="comment-box reply-comment">
                            <div class="comment">
                                <div class="author-thumb"><img src="images/resource/author-2.jpg" alt=""></div>
                                <div class="comment-inner">
                                    <div class="comment-info clearfix"><strong>Christina Bliz</strong></div>
                                    <div class="comment-date">January 29, 2017</div>
                                    <div class="text">The lady met this fellows and they knew it was much more than a hunch and we know Flipper lives in a world full of been wonder flying</div>
                                    <a class="comment-reply" href="#">Reply <span class="fa fa-mail-forward"></span></a>
                                </div>
                            </div>
                        </div>

                        <div class="comment-box">
                            <div class="comment">
                                <div class="author-thumb"><img src="images/resource/author-3.jpg" alt=""></div>
                                <div class="comment-inner">
                                    <div class="comment-info clearfix"><strong>Maxwell</strong></div>
                                    <div class="comment-date">January 29, 2017</div>
                                    <div class="text">The lady met this fellows and they knew it was much more than a hunch and when the odds and we know Flipper lives in a world full of been wonder flying</div>
                                    <a class="comment-reply" href="#">Reply <span class="fa fa-mail-forward"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="comment-form">	
                        <div class="group-title"><h2>Leave a Comment</h2></div>
                        <form method="post" action="contact.html">
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <input name="username" placeholder="Name *" required="" type="text">
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <input name="email" placeholder="Email *" required="" type="email">
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <textarea name="message" placeholder="Comments"></textarea>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <button class="theme-btn btn-style-one" type="submit" name="submit-form">Submit</button>
                                </div>

                            </div>
                        </form>

                    </div>
                    -->
                </section>

                @elseif ($page_type === 'single_event_read')

                <section class="events-single">
                    {!! printReadEventDetails($eventID) !!}
                </section>

                @elseif ($page_type === 'single_raq_read')

                <section class="events-single">
                    {!! printReadFAQDetails($faqID) !!}
                </section>

                @elseif ($page_type === 'single_page_read')

                <section class="events-single">
                    {!! printReadEventDetails($pageID) !!}
                </section>

                @endif

            </div>

            <!--Sidebar-->
            <div class="sidebar-side col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <aside class="sidebar">
                    <!--Category Widget-->

                    {!! printMenuSubMenus(Request::path()) !!}


                    <!-- Search Form -->
                    <!--
                    <div class="sidebar-widget search-box">
                        <div class="sidebar-title">
                            <h3>Search</h3>
                        </div>
                        <form method="post" action="contact.html">
                            <div class="form-group">
                                <input name="search-field" value="" placeholder="Search..." type="search">
                                <button type="submit"><span class="icon fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>
                    -->

                    <!--Popular Events Widget-->
                    <div class="sidebar-widget popular-events">
                        <div class="sidebar-title">
                            <h3>нээлттэй үйл ажиллагаа</h3>
                        </div>

                        {!! printUpcomingEvents() !!}

                        <!--
                        <article class="event-post">
                            <div class="date-box">30 <span>mar</span></div>
                            <div class="text"><a href="blog-single.html">These days are all share a them with meat.</a></div>
                            <div class="event-location">Skozlovia, South Africa</div>
                        </article>

                        <article class="event-post">
                            <div class="date-box">18 <span>apr</span></div>
                            <div class="text"><a href="blog-single.html">These days are all share a them with meat.</a></div>
                            <div class="event-location">Skozlovia, South Africa</div>
                        </article>

                        <article class="event-post">
                            <div class="date-box">05 <span>may</span></div>
                            <div class="text"><a href="blog-single.html">These days are all share a them with meat.</a></div>
                            <div class="event-location">Skozlovia, South Africa</div>
                        </article>
                        -->
                    </div>

                    <!-- Recent From Gallery -->
                    {!! printLatestGalleryImages() !!}
                    <!--
                    <div class="sidebar-widget recent-gallery">
                        <div class="sidebar-title">
                            <h3>зургийн цомог</h3>
                        </div>
                        <div class="clearfix">
                            <figure class="image"><a href="http://t.commonsupport.com/salonika/images/background/3.jpg" class="lightbox-image"><img src="http://t.commonsupport.com/salonika/images/resource/sidebar-gallery-1.jpg" alt=""></a></figure>
                            <figure class="image"><a href="http://t.commonsupport.com/salonika/images/background/1.jpg" class="lightbox-image"><img src="http://t.commonsupport.com/salonika/images/resource/sidebar-gallery-2.jpg" alt=""></a></figure>
                            <figure class="image"><a href="http://t.commonsupport.com/salonika/images/background/2.jpg" class="lightbox-image"><img src="http://t.commonsupport.com/salonika/images/resource/sidebar-gallery-3.jpg" alt=""></a></figure>
                            <figure class="image"><a href="http://t.commonsupport.com/salonika/images/background/3.jpg" class="lightbox-image"><img src="http://t.commonsupport.com/salonika/images/resource/sidebar-gallery-4.jpg" alt=""></a></figure>
                            <figure class="image"><a href="http://t.commonsupport.com/salonika/images/background/1.jpg" class="lightbox-image"><img src="http://t.commonsupport.com/salonika/images/resource/sidebar-gallery-5.jpg" alt=""></a></figure>
                            <figure class="image"><a href="http://t.commonsupport.com/salonika/images/background/2.jpg" class="lightbox-image"><img src="http://t.commonsupport.com/salonika/images/resource/sidebar-gallery-6.jpg" alt=""></a></figure>
                        </div>
                    </div>
                    -->

                    <!--Archive Widget-->
                    <!--
                    <div class="sidebar-widget archive sidebar-blog-category">
                        <div class="sidebar-title">
                            <h3>Archives</h3>
                        </div>
                        <ul class="category">
                            <li><a href="#">January 26, 2017</a></li>
                            <li><a href="#">February 06, 2017</a></li>
                            <li><a href="#">March 14, 2017</a></li>
                        </ul>
                    </div>
                    -->

                </aside>
            </div>

        </div>
    </div>
</div>
@elseif ($type === '02')


@else

Include section anything

@endif