
@if ($type === '01')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Мэдээний гажсан зураг засах зөвлөгөө хуудас</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Зөвлөгөө үзэх</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <strong>мэдээний зарим зураг веб сайтын хэмжээнээс илүү гарсан эсвэл дутуу байгаа байдлын улмаас гажилт үүсэж гонзгой хавтгай болдог үүнийг доорх аргаар засаж болно. </strong>
                        <ul>
                            <li>1. Мэдээ удирдах буюу засах хэсгээр орж засах гэж байгаа мэдээгээ сонгоод тухайн гажилт үүсэж байгаа зургийг сонгоно.</li>
                            <li>2. зургаа сонгосны дараа 2-р сум буюу зурагтай дүрс дээр дарна.</li>
                            <li>3. энэ зургийн хэмжээ хэт том байгаа тул гажилт үүсгэж байна. тиймээс дээрх 2 тоог арилгах юм.</li>
                            <li>4. хэрэв зургийн хэмжээг эргэж дахин дуудах бол дээр эргэлдэх дүрс дээр дарна. </li>
                            <li>5. OK дарж хадгалсны дараа мэдээ дээрх зураг энгийн хэлбэрт орсон байна.</li>
                        </ul>
                        
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/responsive_image/responsive_image_size_guideline_picture_001.png') }}" alt="guide image">
                        <br/>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/responsive_image/responsive_image_size_guideline_picture_002.png') }}" alt="guide image">
                        <br/>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/responsive_image/responsive_image_size_guideline_picture_003.png') }}" alt="guide image">
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /page content -->

@elseif ($type === '02')

Include section 02

@else

Include section anything

@endif