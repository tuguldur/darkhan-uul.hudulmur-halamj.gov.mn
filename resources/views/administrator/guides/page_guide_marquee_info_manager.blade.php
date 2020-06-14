
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
                        <h4 style="color:red;">Гүйдэг зар нь хамгийн сүүлийн идэвхтэй бөгөөд хугацаа нь дуусаагүй зарыг хэвлэдэг тул зар гарахгүй бол хугацааг нь мөн төлөвийг анхаарна. эсвэл дахин засах товч даруул сүүлийн болж орно.</h4>
                        <ul>
                            <li>1. Гүйдэг зар удирдлага хуудсаар орно.</li>
                            <li>2. Гүйдэр зарын хамааралтай нэр оруулна.</li>
                            <li>3. Гүйдэр зарын утгыг товч бөгөөд богино бичнэ. 200 тэмдэгт дотор.</li>
                            <li>4. Гүйдэг зар байрлал сонгоно. Одоогоор дээд гэснийг сонгож байна уу.</li>
                            <li>5. Гүйдэг зарын хугацааг өнөөдөр эсвэл ирээдүйн хугацааг сонгоно. энэ хугацаа ирэхэд энэ зар үзэгдэхгүй болно.</li>
                            <li>6. Гүйдэг зарын идэвхтэй төлөв байдлыг сонгоно. Хэрэв идэвхгүй бол зар үзэгдэхгүй. </li>
                            <li>7. хадгалах товч дарж хадгална. </li>
                            <li>8. сэргээх товч эсвэл F5 дарж хуудсыг сэргэнэ.</li>
                            <li>9. Өмнө оруулсан гүйдэг зарын хугацааг сунгах эсвэл идэвхтэй болгох, засах зэрэгт засах сонгож хэрэглэнэ.</li>
                        </ul>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/marquee_info_editing_guideline_picture_001.png') }}" alt="guide image">
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