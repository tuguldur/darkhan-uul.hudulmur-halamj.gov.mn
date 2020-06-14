
@if ($type === '01')

<!--Main Footer-->
<footer class="main-footer">
    <!--Widgets Section-->
    <div class="widgets-section">
        <div class="auto-container">
            <div class="row clearfix page-part-style" style="background: #f6f6f9;margin-right: 0px;margin-left: 0px;padding-top: 20px;border-top:1px solid #fff;border-bottom: 1px solid #ccc;border-right: 1px solid #fff;">

                <!--Big Column-->
                <div class="big-column col-md-7 col-sm-12 col-xs-12">
                    <div class="row clearfix">

                        <!--Footer Column-->
                        <div class="footer-column col-md-6 col-sm-6 col-xs-12">
                            <div class="footer-widget logo-widget">
                                <div class="footer-logo"><a href="{{config('path_config.APP_PATH')}}"><img src="{{ asset(config('path_config.APP_PATH') . '/images/logo.png') }}" alt=""></a></div>
                                <div class="widget-content">
                                    <div class="text" style="text-align: justify;">{{config('user_config.ORG_VISION')}}</div>
                                    <ul class="contact-info">
                                        <li><div class="icon"><span class="flaticon-house"></span></div>{{config('user_config.ORG_ADDRESS')}}</li>
                                        <li><div class="icon"><span class="flaticon-phone-call"></span></div> 
                                            @foreach (config('user_config.ORG_PHONES') as $key => $value)  
                                            {{ $value }} <br>
                                            @endforeach
                                        </li>
                                        <li><div class="icon"><span class="flaticon-envelope-1"></span></div>
                                            @foreach (config('user_config.ORG_EMAILS') as $key => $value)  
                                            <a href="mailto:{{ $value }}">{{ $value }}</a> <br>
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--Footer Column / Tweet Widget-->
                        <div class="footer-column col-md-6 col-sm-6 col-xs-12">
                            <div class="footer-widget tweets-widget">
                                <h4>Олон нийтийн сүлжээ</h4>

                                <div class="fb-page" data-width="300" data-height="400" data-href="{{config('user_config.ORG_SOCIAL_LINKS.fa-facebook')}}" data-tabs="timeline" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/%D0%91%D1%83%D0%BB%D0%B3%D0%B0%D0%BD-%D0%B0%D0%B9%D0%BC%D0%B3%D0%B8%D0%B9%D0%BD-%D0%A5%D3%A9%D0%B4%D3%A9%D0%BB%D0%BC%D3%A9%D1%80-%D1%85%D0%B0%D0%BB%D0%B0%D0%BC%D0%B6%D0%B8%D0%B9%D0%BD-%D2%AF%D0%B9%D0%BB%D1%87%D0%B8%D0%BB%D0%B3%D1%8D%D1%8D%D0%BD%D0%B8%D0%B9-%D0%B3%D0%B0%D0%B7%D0%B0%D1%80-1834359200144597/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/%D0%91%D1%83%D0%BB%D0%B3%D0%B0%D0%BD-%D0%B0%D0%B9%D0%BC%D0%B3%D0%B8%D0%B9%D0%BD-%D0%A5%D3%A9%D0%B4%D3%A9%D0%BB%D0%BC%D3%A9%D1%80-%D1%85%D0%B0%D0%BB%D0%B0%D0%BC%D0%B6%D0%B8%D0%B9%D0%BD-%D2%AF%D0%B9%D0%BB%D1%87%D0%B8%D0%BB%D0%B3%D1%8D%D1%8D%D0%BD%D0%B8%D0%B9-%D0%B3%D0%B0%D0%B7%D0%B0%D1%80-1834359200144597/">Булган аймгийн Хөдөлмөр, халамжийн үйлчилгээний газар</a></blockquote></div>

                                <!--
                                <div class="tweet">
                                    <div class="icon"><span class="fa fa-twitter"></span></div>
                                    <div class="text">
                                        <p>Fellows and they knew it is sea. <a href="#">http://fontawesome.io/</a></p>
                                    </div>
                                    <span class="days">6 Days ago</span>
                                </div>
                                
                                <div class="tweet">
                                    <div class="icon"><span class="fa fa-twitter"></span></div>
                                    <div class="text">
                                        <p>Skipper too the millionaire a wife.<a href="#">http://fontawesome.io/</a></p>
                                    </div>
                                    <span class="days">8 Days ago</span>
                                </div>

                                <div class="tweet">
                                    <div class="icon"><span class="fa fa-twitter"></span></div>
                                    <div class="text">
                                        <p>Skipper too the millionaire a wife.<a href="#">http://fontawesome.io/</a></p>
                                    </div>
                                    <span class="days">6 Days ago</span>
                                </div>
                                -->
                            </div>
                        </div>

                    </div>
                </div>

                <!--Big Column-->
                <div class="big-column col-md-5 col-sm-12 col-xs-12">
                    <div class="row clearfix">
                        <!--Footer Column / Links Widget-->
                        <div class="footer-column col-md-5 col-sm-6 col-xs-12">
                            <div class="footer-widget links-widget">
                                <h4>газар, хэлтсүүд</h4>
                                <div class="widget-content footer-subsidiary-organizations" id="footerSubsidiaryOrganizations">
                                    <ul class="list">
                                        @foreach (config('path_config.SAME_RELATION_ORGS') as $key => $value)  
                                        <li><a href="{{ $value }}" target="_blank">{{ $key }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--Footer Column / Contact Widget-->
                        <div class="footer-column col-md-7 col-sm-6 col-xs-12">
                            <div class="footer-widget contact-widget">
                                <h4>Санал, хүсэлт өгөх</h4>

                                <div class="widget-content">
                                    <div class="contact-form">
                                        <form method="post" action="/contact-form/submit" onsubmit="return validateContactForm(this);">
                                            <div class="form-group">
                                                <input type="text" name="contactPersonName" id="contactPersonName" value="" placeholder="Таны нэр *" required="required" oninvalid="this.setCustomValidity('Та өөрийн нэрээ энд бичнэ үү.')" oninput="setCustomValidity('')" maxlength="30">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="contactPersonRegister" id="contactPersonRegister" value="" placeholder="Таны регистрийн дугаар" required="required" oninvalid="this.setCustomValidity('Та өөрийн регистрийн дугаараа энд бичнэ үү.')" oninput="setCustomValidity('')" maxlength="10">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="contactPersonPhone" id="contactPersonPhone" value="" placeholder="Утасны дугаар *" required="required"  maxlength="9">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="contactPersonEmail" id="contactPersonEmail" value="" placeholder="Э-мэйл хаяг " maxlength="30">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="contactPersonText" id="contactPersonText" placeholder="Санал, хүсэлтийн агуулга энд бичнэ" oninvalid="this.setCustomValidity('Санал, хүсэлтийн агуулга энд бичнэ үү.')" oninput="setCustomValidity('')" required="required" maxlength="500"></textarea>
                                            </div>
                                            <!--
                                            <div class="form-group">
                                                <?php
                                                //$min_number = 2;
                                                //$max_number = 19;
                                                //$random_number1 = mt_rand($min_number, $max_number);
                                                //$random_number2 = mt_rand($min_number, $max_number);
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6" style="font-size: 18px;font-weight: bold;padding-top: 10px;">
                                                        <?php
                                                            //echo $random_number1 . ' + ' . $random_number2 . ' = ';
                                                        ?>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <input name="captchaResult" type="text" oninvalid="this.setCustomValidity('дээрх 2 тооны нийлбэрийг энд бичнэ үү.')" oninput="setCustomValidity('')" required="required" maxlength="2" style="font-size: 18px;font-weight: bold;" />
                                                        <input name="firstNumber" type="hidden" value="" />
                                                        <input name="secondNumber" type="hidden" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            -->
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <button type="submit" name="contactPersonSavBtn" id="contactPersonSavBtn" class="theme-btn btn-style-one">илгээх</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--Footer Bottom-->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="row clearfix page-part-style" style="background: #F6F6F9;margin-right: 0px;margin-left: 0px;border-top: 1px solid #fff;border-left: 1px solid #fff;border-right: 1px solid #fff;">
                <!--Card Column-->
                <div class="card-column col-md-4 col-sm-12 col-xs-12">
                    <ul class="social-icon-two">
                        @foreach (config('user_config.ORG_SOCIAL_LINKS') as $key => $value)  
                        <li><a href="{{ $value }}"><span class="fa {{ $key }}"></span></a></li>
                        @endforeach
                    </ul>
                </div>
                <!--Social Column-->
                <div class="social-column col-md-4 col-sm-12 col-xs-12">

                </div>

                <!--copyright column-->
                <div class="copyright-column col-md-4 col-sm-12 col-xs-12">
                    <div class="copyright">{{config("user_config.WEB_COPYRIGHT")}}</div>
                </div>
            </div>
        </div>
    </div>
    <!--End Footer Bottom-->

</footer>
<!--End Footer-->

@elseif ($type === '02')

Include section 02

@else

Include section anything

@endif