
@if ($type === '01')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Ерөнхий мэдээлэл удирдах хэсгийн зөвлөгөө хуудас</h3>
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
                            <li>1. <a href="https://webmail2.gov.mn:2083" target="_blank">https://webmail2.gov.mn:2083</a> холбоос луу орно.</li>
                            <li>2. <strong>File Manager</strong> -р орно.</li>
                            <li>3. <strong>public_html</strong> хавтас луу орно.</li>
                            <li>4. <strong>config</strong> хавтас луу орно. </li>
                            <li>5. <strong>user_config.php</strong> файлыг edit дарж засах байдлаар орно.</li>
                            <li>6. <strong>user_config.php</strong> файлыг нээхэд доорх зураг дээр байгаа байдал гарч ирнэ. </li>
                            <li>6. зөвхөн мэдээллийг <strong>'text'</strong> ийм <strong>2</strong> цэгийн хооронд бичнэ. </li>
                            <li>7. энэ мэдээллүүд хөх өнгөөс бусад өнгөтэй болбол алдаа болно.</li>
                            <li>8. тогтмол байх ийм мэдээллийг өгөгдлийн сангаас авах нь системд нэмэлт ачаалал үүсгэх тул файл дээрээс авч хэрэглэж байгаа.</li>
                        </ul>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/general_info_editing_guideline_picture_001.png') }}" alt="guide image">
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