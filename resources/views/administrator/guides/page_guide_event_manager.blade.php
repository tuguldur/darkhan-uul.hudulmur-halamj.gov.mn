
@if ($type === '01')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Үйл ажиллагаа удирдах хэсгийн зөвлөгөө хуудас</h3>
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
                        <h2>Зөвлөгөө бичвэр</h2>
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
                            <li>1. үйл ажиллагаа удирдах хуудсаар орно</li>
                            <li>2. үйл ажиллагааны мэдээллийн гарчиг бичиж өгнө.</li>
                            <li>3. үйл ажиллагаанд хамааралтай зургийг оруулж өгнө. <span class="label label-warning">Хэрэв засварлаж байгаа үед зураг солих шардлагагүй бол зураг оруулахгүй байж болно.</span> жишээ нь: өлгөдөг хулдаасны эх бэлтгэл зураг, өмнөх болж байсан арга хэмжээний зураг, интернетээс авах гэх мэт</li>
                            <li>4. үйл ажиллагааны агуулга хэсэгт тухайн үйл ажиллагаа дээр юу юу болох ямар үйлчилгээ авч болох гэх мэт дэлгэрүүлж бичнэ. үйл ажиллагаа дуусны дараа мөн нэмж тайлан мэдээ засварлан оруулж болно.</li>
                            <li>5. тухайн үйл ажиллагаан дээр авсан гэрэл зургуудийг зургийн цомог байдлаар оруулах гэж байгаа.</li>
                            <li>6. тухайн үйл ажиллагаа хаана болох гэж байгаа хаягыг бичнэ. </li>
                            <li>7. тухайн үйл ажиллагааны талаар иргэд асуух зүйл гарвал хэнээс асуувал мэдээлэл өгөх хүн/албан байгууллага утасны дугаар. </li>
                            <li>8. тухайн үйл ажиллагааны талаар мэдээллийг э-мэйлээр авч, өгөх тохиолдолд хэрэглэнэ.</li>
                            <li>9. үйл ажиллагааны төлөв идэвхгүй бол веб сайт дээр тухайн үйл ажиллагааны мэдээлэл гарахгүй. устгах үйл ажиллагаа байвал эхлээд идэвхгүй төлөв оруулж үлдээж болно.</li>
                            <li>10. Тухайн үйл ажиллагаа болох өдрийн сонгож оруулна.</li>
                            <li>11. Тухайн үйл ажиллагаа дээрх өдөр эхлэх цагийг оруулна.</li>
                            <li>12. Тухайн үйл ажиллагаа дээрх өдөр дуусах цагийг оруулна. дуусах цаг эхлэх цагаас үргэлж хойно байхаар сонгоно.</li>
                            <li>13. Мэдээлэл зөв бол хадгалах товч дээр дарж хадгална.</li>
                            <li><span class="label label-warning">үйл ажиллагааг засах, устгах үйлдлийг доорх үйл ажиллагааны хүснэгтээс сонгож дээрх 1-13 хүртэл адил хийнэ.</span></li>
                        </ul>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/event/event_manager_editing_guideline_picture_002.png') }}" alt="guide image">
                        <br/>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/event/event_manager_editing_guideline_picture_003.png') }}" alt="guide image">
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