
@if ($type === '01')

<!--Services Section-->
<section class="services-section">
    <div class="auto-container">

        <div class="row clearfix page-part-style" style="background: #fff;margin: auto 0;padding-top: 10px;">

            <!--Services Style One-->
            <div class="services-style-one col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    <h3 style="color: #333;"><a href="#">Сүүлд нэмэгдсэн</a></h3>
                    <div class="post-content-scroll" id="postContentScroll01">
                        {!! printFrontLatestContentHTML() !!} 
                    </div>
                    <!--
                    <div class="arrow-box"><a href="#" class="arow flaticon-list"></a></div>
                    -->
                </div>
            </div>

            <!--Services Style One-->
            <div class="services-style-one col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    <h3><a href="#">Олон уншсан</a></h3>
                    <div class="post-content-scroll" id="postContentScroll02">
                        {!! printFrontMostReadContentHTML() !!}
                    </div>
                    <!--
                    <div class="arrow-box"><a href="#" class="arow flaticon-list"></a></div>
                    -->
                </div>
            </div>

            <!--Services Style One-->
            <div class="services-style-one col-md-4 col-sm-6 col-xs-12">
                <div class="inner-box">
                    <h3><a href="#">Түгээмэл асуултууд</a></h3>
                    <div class="post-content-scroll" id="postContentScroll03">
                        {!! printFrontFAQsHTML() !!}
                    </div>
                    <!--
                    <div class="arrow-box"><a href="#" class="arow flaticon-list"></a></div>
                    -->
                </div>
            </div>

        </div>

    </div>
</section>
<!--End Services Section-->

@elseif ($type === '02')

Include section 02

@else

Include section anything

@endif