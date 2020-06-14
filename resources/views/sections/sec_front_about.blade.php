
@if ($type === '01')

<!--About Section-->
<section class="about-section">
    <div class="auto-container">
        <div class="about-inner">
            <div class="row clearfix" style="margin: auto 0;">
                <div class="image-column col-md-12 col-sm-12 col-xs-12" style="background: #fff; padding: 0;">
                    <h3 class="job-map-title">Нээлттэй ажлын байрны мэдээлэл</h3>
                    <div id="chartdiv"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End About Section-->

@elseif ($type === '02')

Include section 02

@else

Include section anything

@endif