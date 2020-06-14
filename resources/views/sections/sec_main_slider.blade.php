
@if ($type === '01')

<!--Main Slider-->
<section class="main-slider" data-start-height="750" data-slide-overlay="yes">
    <div class="container">
        <div class="row page-part-style" style="background: #fff;">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-9 no-padding" style="background: #fff; padding-top: 10px; padding-bottom: 10px;">
                {!! printFrontFourSlider() !!}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3" style="background: #fff; padding-top: 10px; padding-bottom: 10px;height: 100%;">
                {!! printFrontTwoPages() !!}
                <!--
                <div>
                    <a href="http://check.hudulmur-halamj.gov.mn/check/">
                        <img src="{{ asset(config('path_config.APP_PATH'). 'uploads/photos/banners/child-money-checking.png') }}" alt="Хүүхдийн мөнгө шалгах" title="Хүүхдийн мөнгө шалгах" width="300">
                    </a>
                </div>
                <div style="margin-top: 10px;height: 100%;">
                    <a href="https://www.youtube.com/watch?v=BFZof-DoiiM" target="_blank">
                        <img src="{{ asset(config('path_config.APP_PATH'). 'uploads/photos/banners/child-money-receive-with-mother.png') }}" alt="Хүүхдийн мөнгө хэрхэн авах тухай" title="Хүүхдийн мөнгө хэрхэн авах тухай" width="300" height="198">
                    </a>
                </div>
                -->
            </div>
        </div>
    </div>
    <div style="max-width: 1200px;margin: 0 auto;">

        <!--
        <ul class="pgwSlider">
            <li>
                <img src="http://static.pgwjs.com/img/pg/slider/paris.jpg" alt="Paris, France" data-description="Eiffel Tower and Champ de Mars">
            </li>
            <li>
                <img src="http://static.pgwjs.com/img/pg/slider/montreal_mini.jpg" alt="Montréal, QC, Canada" data-large-src="http://static.pgwjs.com/img/pg/slider/montreal.jpg">
            </li>
            <li>
                <img src="http://static.pgwjs.com/img/pg/slider/shanghai.jpg">
                <span>Shanghai, China</span>
            </li>
            <li>
                <a href="http://www.nyc.gov" target="_blank">
                    <img src="http://static.pgwjs.com/img/pg/slider/new-york.jpg">
                    <span>New York, NY, USA</span>
                </a>
            </li>
        </ul>
        -->
    </div>
    <!--
    <div class="tp-banner-container container">
        <div class="tp-banner">
            <ul>

                <li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="http://t.commonsupport.com/salonika/images/main-slider/image-1.jpg"  data-saveperformance="off"  data-title="Awesome Title Here">
                    <img src="http://t.commonsupport.com/salonika/images/main-slider/image-1.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 

                    <div class="tp-caption sfl sfb tp-resizeme"
                         data-x="left" data-hoffset="15"
                         data-y="center" data-voffset="-120"
                         data-speed="1500"
                         data-start="500"
                         data-easing="easeOutExpo"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.01"
                         data-endelementdelay="0.3"
                         data-endspeed="1200"
                         data-endeasing="Power4.easeIn"><div class="title styled-text">Fellows and they knew it was much more than a hunch.</div></div>

                    <div class="tp-caption sfl sfb tp-resizeme"
                         data-x="left" data-hoffset="15"
                         data-y="center" data-voffset="-10"
                         data-speed="1500"
                         data-start="1000"
                         data-easing="easeOutExpo"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.01"
                         data-endelementdelay="0.3"
                         data-endspeed="1200"
                         data-endeasing="Power4.easeIn"><h2>We can’t help everyone, but everyone <br> can help someone</h2></div>

                    <div class="tp-caption sfl sfb tp-resizeme"
                         data-x="left" data-hoffset="15"
                         data-y="center" data-voffset="110"
                         data-speed="1500"
                         data-start="1500"
                         data-easing="easeOutExpo"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.01"
                         data-endelementdelay="0.3"
                         data-endspeed="1200"
                         data-endeasing="Power4.easeIn"><a href="contact.html" class="theme-btn btn-style-one">Contact Us</a> &ensp; <a href="contact.html" class="theme-btn btn-style-two">READ MORE</a></div>

                </li>

                <li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="http://t.commonsupport.com/salonika/images/main-slider/image-2.jpg"  data-saveperformance="off"  data-title="Awesome Title Here">
                    <img src="http://t.commonsupport.com/salonika/images/main-slider/image-2.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 

                    <div class="tp-caption sft sfb tp-resizeme"
                         data-x="center" data-hoffset="0"
                         data-y="center" data-voffset="-90"
                         data-speed="1500"
                         data-start="500"
                         data-easing="easeOutExpo"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.01"
                         data-endelementdelay="0.3"
                         data-endspeed="1200"
                         data-endeasing="Power4.easeIn"><div class="title">Welcome to Salonika Charity & Fundraising</div></div>

                    <div class="tp-caption sfb sfb tp-resizeme"
                         data-x="center" data-hoffset="0"
                         data-y="center" data-voffset="10"
                         data-speed="1500"
                         data-start="1000"
                         data-easing="easeOutExpo"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.01"
                         data-endelementdelay="0.3"
                         data-endspeed="1200"
                         data-endeasing="Power4.easeIn"><h2 class="text-center">Giving is not just about making <span class="theme_color">Donation</span> <br> it is about making <span class="theme_color">Difference</span></h2></div>

                    <div class="tp-caption sfb sfb tp-resizeme"
                         data-x="center" data-hoffset="0"
                         data-y="center" data-voffset="130"
                         data-speed="1500"
                         data-start="1500"
                         data-easing="easeOutExpo"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.01"
                         data-endelementdelay="0.3"
                         data-endspeed="1200"
                         data-endeasing="Power4.easeIn"><a href="contact.html" class="theme-btn btn-style-one">Contact Us</a></div>

                </li>

            </ul>

        </div>
    </div>
    -->
</section>
<!--End Main Slider-->

@elseif ($type === 'car_detail')


@elseif ($type === 'contact_us')


@else

Include section anything

@endif