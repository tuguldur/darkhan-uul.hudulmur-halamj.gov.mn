
@if ($type === '01')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Хуучин мэдээ засварлах хэсгийн зөвлөгөө хуудас</h3>
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
                        <ul>
                            <li>1. хэрэв мэдээ дээрх зураг харахгүй мөн <strong>PDF</strong> нээгдэхгүй бол доод <strong>URL</strong> харах</li>
                            <li>2. <strong>URL</strong> хаяг дунд <strong>/backend/web/</strong> гэсэн байгаа бол энэ өмнөх хуучин веб зам тул буруу байна.</li>
                            <li>3. зам олдохгүй зурагтай мэдээ ингэж харагдаж байгаа.</li>
                            <li>4. тэгвэл мэдээ удирдах хэсгээр орж тухайн мэдээллийг засахаар нээгээд зургийг сонгож <strong>browse server</strong>-с сонгож болно.</li>
                            <li>5. <strong>Source</strong> дээр дараад тухайн мэдээний арын кодыг нээж засаж болно.</li>
                            <li>6. мэдээний арын кодыг нээхэд зургийн зам буруу байна. тэгвэл <strong>/backend/web</strong> гэж сонгосон хөх хэсгийн <strong>/uploads/...</strong> хүртэл арилгана. </li>
                            <li>7. <strong>Source</strong> дээр дарж арын код үзүүлэх хэсгийг хааж зураг замаа олсон эсэхийг харна.</li>
                            <li>8. хэрэв зураг замаа олсон бол ийм байдалтай харагдана. зураг замаа олсон бол мэдээг хадгална.</li>
                        </ul>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/old-news/edit-old-news-001.png') }}" alt="guide image">
                        <br/><br/>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/old-news/edit-old-news-002.png') }}" alt="guide image">
                        <br/><br/>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/old-news/edit-old-news-003.png') }}" alt="guide image">
                        <br/><br/>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/old-news/edit-old-news-004.png') }}" alt="guide image">
                        <br/><br/>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/old-news/edit-old-news-005.png') }}" alt="guide image">
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