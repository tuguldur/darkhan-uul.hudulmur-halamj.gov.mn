
@if ($type === '01')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Цомог удирдах хуудас</h3>
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
                        <h2>Цомог засвар <small>нэмэх, засах</small></h2>
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
                        <form id="album-manager-form" method="POST" action="/administrator/album/albumActionManagerDAO" enctype="multipart/form-data" onsubmit="return validateAlbumForm(this);" data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="albumID">Цомог ID <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="albumID" id="albumID" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="albumTitle">Цомог гарчиг <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="albumTitle" name="albumTitle" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="albumCoverImage" class="control-label col-md-3 col-sm-3 col-xs-12">Цомог зураг </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img class="img-responsive img-thumbnail" name="albumCoverImage" id="albumCoverImage" src="{{ asset(config('path_config.APP_PATH'). '/images/no_image.png') }}" style="width: 200px;"/>
                                    <input type="file" id="albumCoverImageFile" name="albumCoverImageFile" accept="image/*" class="form-control col-md-7 col-xs-12">
                                    <input type="hidden" id="albumCoverImageNameHidden" name="albumCoverImageNameHidden" readonly="readonly" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="albumContent" class="control-label col-md-3 col-sm-3 col-xs-12">Цомог агуулга </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="albumContent" name="albumContent" class="resizable_textarea form-control" placeholder="энэ талбарт зургийн цомгийн талаар товч мэдээлэл бичнэ үү..."></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="single_cal2" class="control-label col-md-3 col-sm-3 col-xs-12">Цомог хугацаа </label>
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" name="albumDate" id="single_cal2" placeholder="огноо сонго" aria-describedby="inputSuccess2Status2" readonly="readonly">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="form-group">
                                <label for="albumActiveStatus" class="control-label col-md-3 col-sm-3 col-xs-12">Цомог төлөв </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" checked="" value="1" id="albumActiveStatus01" name="albumActiveStatus"> идэвхтэй
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="0" id="albumActiveStatus02" name="albumActiveStatus"> идэвхгүй
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="albumActionCodeHidden" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="albumActionTypeHidden" id="albumActionTypeHidden" readonly="" required="" value="create"/>
                                    <input type="hidden" name="albumActionCodeHidden" id="albumActionCodeHidden" readonly=""/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" readonly="">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">болих</button>
                                    <button class="btn btn-primary" type="reset">сэргээх</button>
                                    <button type="submit" name="albumManagerSaveBtn" id="albumManagerSaveBtn" class="btn btn-success">хадгалах</button>
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
                        <h2>Өмнөх хуудаснууд <small>харах, засах, устгах</small></h2>
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
                            хүснэгтэд гарч ирсэн цомогуудын арын үйлдэл товч дээрээ засах, устгах, харах үйлдэл хийж болно.
                        </p>
                        {!! printAlbumTable() !!}
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