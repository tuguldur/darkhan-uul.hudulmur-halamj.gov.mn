
@if ($type === '01')

<!-- page content -->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Мэдээ удирдах хуудас</h3>
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
                        <h2>Мэдээ засвар <small>нэмэх, засах</small> 
                            <span class="label label-info"><a href="/administrator/guide/news_manager/" target="_blank">мэдээ оруулах заавар үзэх</a></span>
                            <span class="label label-info"><a href="/administrator/guide/edit_image_resize/" target="_blank">мэдээний зургийн хэмжээ өөрчлөх заавар</a></span>
                            <span class="label label-info"><a href="/administrator/guide/edit_none_responsive_image/" target="_blank">мэдээний гажсан зураг засах</a></span>
                        </h2>
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
                        @if (Session::has('form_success'))
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>Мэдэгдэл!</strong> {!! Session::get('form_success') !!}
                        </div>
                        @endif

                        @if (Session::has('form_fail'))
                        <div class="alert alert-warning alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>Мэдэгдэл!</strong> {!! Session::get('form_fail') !!}
                        </div>
                        @endif


                        <br />
                        <form id="news-manager-form" method="POST" action="/administrator/news/newsActionManagerDAO" enctype="multipart/form-data" onsubmit="return validateNewsForm(this);" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="newsID">Мэдээний цэс <span class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    {!! printNewsMenuAdminPage() !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="newsID">Мэдээний ID <span class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" name="newsID" id="newsID" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="newsTitle">Мэдээний гарчиг <span class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="newsTitle" name="newsTitle" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newsCoverImage" class="control-label col-md-2 col-sm-2 col-xs-12">Мэдээний гарчиг зураг </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <span style="color:red;">шаардлагагүй бол зураг сонгохгүй байж болно</span>
                                    <img class="img-responsive img-thumbnail" name="newsCoverImage" id="newsCoverImage" src="{{ asset(config('path_config.APP_PATH'). '/images/no_image.png') }}" style="width: 200px;"/>
                                    <input type="file" id="newsCoverImageFile" name="newsCoverImageFile" accept="image/*" class="form-control col-md-7 col-xs-12">
                                    <br/>
                                    <span style="color:red;">дээрх зургийн хэмжээ өргөн = {{config('file_sizes.CONTENT_COVER_IMAGE.MAX_WIDTH')}} pixel, өндөр = {{config('file_sizes.CONTENT_COVER_IMAGE.MAX_HEIGHT')}} pixel хэмжээнээс дээш, чанартай, мэдээний утгатай нийцсэн зураг байх хэрэгтэй. Учир нь зургийг хэмжээнд тайрч тохируулдаг. Эсвэл энэ хэмжээнээс том зураг оруулах шаардлагатай.</span>
                                    <input type="hidden" id="newsCoverImageNameHidden" name="newsCoverImageNameHidden" readonly="readonly" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newsBriefText" class="control-label col-md-2 col-sm-2 col-xs-12">Мэдээний хураангуй </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <textarea id="newsBriefText" name="newsBriefText" class="resizable_textarea form-control" placeholder="энэ талбарт мэдээний товч утга 200 тэмдэг дотор бичнэ үү..."></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newsContent" class="control-label col-md-2 col-sm-2 col-xs-12"> </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <span class="label label-success"><a href="/administrator/file-upload/manager/" target="_blank" style="color:#fff;">Файл хуулах өөр арга (үүгээр файлаа хуулаад дараа нь мэдээндээ browse server-р оруулна)</a></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newsContent" class="control-label col-md-2 col-sm-2 col-xs-12">Мэдээний агуулга </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <textarea id="newsContent" name="newsContent" class="resizable_textarea form-control" placeholder="энэ талбарт мэдээний бүтэн агуулга бичнэ үү..."></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="newsPDFFile">Мэдээний PDF файл sdfsdf
                                </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="file" id="newsPDFFile" accept="application/pdf" name="newsPDFFile" class="form-control col-md-7 col-xs-12">
                                    <input type="hidden" id="newsPDFFilenameHidden" name="newsPDFFilenameHidden" readonly="readonly" class="form-control col-md-7 col-xs-12">
                                    <br/>
                                    <span style="color:red;">мэдээний PDF файлын нэр зөв Англи үсэг, тоо, -, _ орсон зайгүй байна. СЧАБ-ны захиалга.pdf гэхийг SCHAB-in-zakhialga.pdf гэх мэт бичнэ.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Мэдээний төрөл </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select name="newsMediaType" id="newsMediaType" class="form-control">
                                        <option value="none"> - сонгох - </option>
                                        <option value="1">Нүүр хуудас дээр солигдаж харагдана</option>
                                        <option value="2">Нүүр хуудас дээр солигдаж харагдахгүй</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Мэдээний үзсэн </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="newsViewCount" name="newsViewCount" readonly="readonly" class="form-control col-md-7 col-xs-12" maxlength="7">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Мэдээний онцлох </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" checked="" value="0" id="newsSpecial02" name="newsSpecial"> Онцлох мэдээ биш
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="1" id="newsSpecial01" name="newsSpecial"> Онцлох мэдээ мөн
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12">Мэдээний хугацаа </label>
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-10 col-sm-10 col-xs-12 xdisplay_inputx form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" readonly="" name="newsDate" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-2 col-sm-2 col-xs-12"></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="hidden" name="newsMenuIDHidden" id="newsMenuIDHidden" readonly="" required=""/>
                                    <input type="hidden" name="newsActionTypeHidden" id="newsActionTypeHidden" readonly="" required="" value="create"/>
                                    <input type="hidden" name="newsActionCodeHidden" id="newsActionCodeHidden" readonly=""/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" readonly="">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">болих</button>
                                    <button class="btn btn-primary" type="reset">сэргээх</button>
                                    <button type="submit" name="newsManagerSaveBtn" id="newsManagerSaveBtn" class="btn btn-success">хадгалах</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Өмнөх мэдээнүүд <small>харах, засах, устгах</small></h2>
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
                        <p class="text-muted font-13 m-b-30">
                            Мэдээний цэсийг эхлэн сонгож доорх хүснэгтэд гарч ирсэн мэдээнүүдийн арын үйлдэл товч дээрээ засах, устгах, харах үйлдэл хийж болно.
                        </p>
                        <div id="menuNewsTableContainer">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Алдаатай мэдээнүүд <small>харах, засах, устгах</small></h2>
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
                        <div class="col-md-12">
                            <h4>Анааруулга утга</h4>
                            <span class="label label-success">амжилттай</span>
                            <span class="label label-info">мэдээлэл</span>
                            <span class="label label-warning">анхаарах</span>
                            <span class="label label-danger">аюултай</span>
                        </div>
                        <p class="text-muted font-13 m-b-30">
                            Мэдээний цэсийг эхлэн сонгож доорх хүснэгтэд гарч ирсэн мэдээнүүдийн арын үйлдэл товч дээрээ засах, устгах, харах үйлдэл хийж болно.
                        </p>
                        <div id="menuErrorNewsTableContainer">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Цэс буруу мэдээнүүд <small>харах, засах, устгах</small></h2>
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
                        <div class="col-md-12">
                            <h4>Анааруулга утга</h4>
                            <span class="label label-success">амжилттай</span>
                            <span class="label label-info">мэдээлэл</span>
                            <span class="label label-warning">анхаарах</span>
                            <span class="label label-danger">аюултай</span>
                        </div>
                        <p class="text-muted font-13 m-b-30">
                            Мэдээний цэсийг эхлэн сонгож доорх хүснэгтэд гарч ирсэн мэдээнүүдийн арын үйлдэл товч дээрээ засах, устгах, харах үйлдэл хийж болно.
                        </p>
                        
                        {!! printNullMenuIDTableByHTML() !!}
                        
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