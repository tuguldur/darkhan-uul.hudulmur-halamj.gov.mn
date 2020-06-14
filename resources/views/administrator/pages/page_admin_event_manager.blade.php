
@if ($type === '01')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Үйл ажиллагаа удирдах хуудас</h3>
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
                        <h2>Үйл ажиллагаа засвар <small>нэмэх, засах</small></h2>
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
                            <strong>Мэдэгдэл!</strong> {!! Session::get('form_success') !!}
                        </div>
                        @endif

                        <br />
                        <form id="news-manager-form" method="POST" action="/administrator/event/eventActionManagerDAO" enctype="multipart/form-data" onsubmit="return validateEventForm(this);" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eventID">Үйл ажиллагаа ID <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="eventID" id="eventID" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eventTitle">Үйл ажиллагаа гарчиг <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="eventTitle" name="eventTitle" placeholder="ямар үйл ажиллагаа болох тухай гарчиг бичнэ" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="eventCoverImage" class="control-label col-md-3 col-sm-3 col-xs-12">Үйл ажиллагаа зураг </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img class="img-responsive img-thumbnail" name="eventCoverImage" onchange="onFileSelected();" id="eventCoverImage" src="{{ asset(config('path_config.APP_PATH'). '/images/no_image.png') }}" style="width: 200px;"/>
                                    <input type="file" id="eventCoverImageFile" name="eventCoverImageFile" accept="image/*" class="form-control col-md-7 col-xs-12">
                                    <input type="hidden" id="eventCoverImageNameHidden" name="eventCoverImageNameHidden" readonly="readonly" class="form-control col-md-7 col-xs-12">
                                    <br/>
                                    <span style="color:red;">Үйл ажиллагааний нүүр зургийг өргөн нь {{config('file_sizes.EVENT_COVER_IMAGE.MAX_WIDTH')}} pixel, өндөр нь {{config('file_sizes.EVENT_COVER_IMAGE.MAX_HEIGHT')}} pixel хэмжээтэй байгаах тохируулж оруулна уу.
                                        Эсвэл үүнээс том хэмжээтэй зураг байна. Програм тухайн үйл ажиллагааны нүүр зургийг энэ хэмжээгээр тайрч тохируулдаг.
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="eventContent" class="control-label col-md-3 col-sm-3 col-xs-12">Үйл ажиллагаа агуулга </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="eventContent" name="eventContent" class="resizable_textarea form-control" placeholder="энэ талбарт үйл ажиллагааны бүтэн агуулга бичнэ үү..."></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Үйл ажиллагаа зургууд </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img class="img-responsive img-thumbnail" src="http://www.aal-europe.eu/wp-content/uploads/2013/12/events_medium.jpg" style="width: 200px;"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Үйл ажиллагаа байрлал </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    газрын зураг сонгож оруулдаг болгох
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eventLocation">Үйл ажиллагаа хаяг </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="eventLocation" name="eventLocation" placeholder="үйл ажиллагааны хаана болох талаар байрлал хаяг бичнэ." class="form-control col-md-7 col-xs-12" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for=eventPhones>Үйл ажиллагаа утас </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="eventPhones" name="eventPhones" placeholder="үйл ажиллагааны талаар асууж мэдээлэл авах утасны дугаар бичнэ." class="form-control col-md-7 col-xs-12" maxlength="20" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="eventEmail">Үйл ажиллагаа эмэйл </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="eventEmail" name="eventEmail" placeholder="үйл ажиллагааны талаар асууж мэдээлэл авах э-мэйл хаяг бичнэ." class="form-control col-md-7 col-xs-12" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="eventStatus" class="control-label col-md-3 col-sm-3 col-xs-12">Үйл ажиллагаа төлөв </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" checked="" value="1" id="eventStatus01" name="eventStatus"> идэвхтэй
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="0" id="eventStatus02" name="eventStatus"> идэвхгүй
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="eventDateTime" class="control-label col-md-3 col-sm-3 col-xs-12">Үйл ажиллагаа болох өдөр </label>
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" name="eventDateTime" id="single_cal2" placeholder="хугацаа сонго" readonly="readonly" aria-describedby="inputSuccess2Status2">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="form-group">
                                <label for="eventDateTime" class="control-label col-md-3 col-sm-3 col-xs-12">Үйл ажиллагаа эхлэх цаг </label>
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <small class="label label-warning">үйл ажиллагаа эхлэх цагийг арын товч дээр дарж оруулна уу</small>
                                                <div class="form-group">
                                                    <div class='input-group date' id='eventStartTime'>
                                                        <input type='text' class="form-control" name="eventStartTime" id="eventStartTimeId"/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="form-group">
                                <label for="eventDateTime" class="control-label col-md-3 col-sm-3 col-xs-12">Үйл ажиллагаа дуусах цаг </label>
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <small class="label label-warning">үйл ажиллагаа дуусах цаг эхлэх цагаас ямагт хойно байна</small>
                                                <div class="form-group">
                                                    <div class='input-group date' id='eventEndTime'>
                                                        <input type='text' class="form-control"  name="eventEndTime" id="eventEndTimeId"/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="form-group">
                                <label for="eventActionCodeHidden" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="eventActionTypeHidden" id="eventActionTypeHidden" readonly="" required="" value="create"/>
                                    <input type="hidden" name="eventActionCodeHidden" id="eventActionCodeHidden" readonly=""/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" readonly="">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">болих</button>
                                    <button class="btn btn-primary" type="reset">сэргээх</button>
                                    <button type="submit" name="eventManagerSaveBtn" id="eventManagerSaveBtn" class="btn btn-success">хадгалах</button>
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
                    </div>
                    <div class="x_content">
                        <p>Хэрэв үйл ажиллагааны мэдээлэл оруулах үед доорх адил алдаа гарвал Cpanel-н FileManager ороод тухайн замын хамгийн сүүлийн covers фолдерыг 777 эрхтэй болгох хэрэгтэй.</p>
                        <img class="img-responsive img-rounded img-thumbnail" src="/images/guidelines/administrator/event/event_manager_editing_guideline_picture_001.png" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Өмнөх үйл ажиллагаанууд <small>харах, засах, устгах</small></h2>
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
                        <a href="https://developers.facebook.com/tools/debug/sharing/" target="_blank">https://developers.facebook.com/tools/debug/sharing/</a>
                        <br/>
                        <span class="label label-info">Үйл ажиллагааний холбоосыг дээрх Facebook хуудас дээр бичиж DEBUG товч дээр дарж Facebook мэдээллийг бүртгэнэ. </span>
                        <br/><br/>
                        {!! printEventsTableHTML() !!}
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