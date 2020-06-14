
@if ($type === '01')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Холбоос удирдах хэсгийн зөвлөгөө хуудас</h3>
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
                        <a href="/uploads/link/link-template.psd" class="btn btn-info" role="button">Холбоос засах PSD файл татах</a>
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
                            <li>1. холбоос удирдах хуудсаар орно</li>
                            <li>2. тухайн холбоос зураг дээр дарах нээгдэх веб сайтын ажиллагаатай хаяг бичнэ. жишээ нь: https://www.iaac.mn/ гэх мэт нэг хаяг бичнэ.</li>
                            <li>3. тухайн холбоосын зугийг оруул өгнө. хэрэв засах бол холбоос удирдах хуудасны дээр байгаа загвар photoshop файлыг татаж авч дээр нь засвар хийнэ үү.</li>
                            <li>4. холбоосын шинэ хуучин бүх зургуудийг энэ LINK гэсэн нэртэй фолдерт хийнэ. </li>
                            <li>5. Жишээ нь: Авилгалтай тэмцэх газрын холбоос оруулах гэж байгаа бол зургийг сонгож талбарт зургийн замыг оруулна.</li>
                            <li>6. холбоос идэвхтэй эсвэл идэвхгүй эсэхийг сонгоно. хэрэв идэвхгүйг сонговол холбоос веб дээр харагдахгүй. </li>
                            <li>6. шинэ холбоос зураг оруулах гэж байгаа бол шинээр фолдер, файл үүсгэдэг товчыг хэрэглэнэ. </li>
                            <li>7. Дээрх мэдээлэл бүгд зөв оруулагдсан бол хадгалах товч дээр дарж мэдээллийг хадгална.</li>
                            <li>8. хэрэв холбоосыг засах устгах бол үйлдэл товч дээрх сумаас нэмэлт үйлдэл сонгож засварлаж, устгана.</li>
                        </ul>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/link_manager_editing_guideline_picture_001.png') }}" alt="guide image">
                        <br/>
                        <img class="img-responsive img-thumbnail" src="{{ asset('/images/guidelines/administrator/link_manager_editing_guideline_picture_002.png') }}" alt="guide image">
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