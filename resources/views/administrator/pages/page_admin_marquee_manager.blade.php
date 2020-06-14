
@if ($type === '01')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Гүйдэг зар удирдах хуудас</h3>
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
                        <h2>Гүйдэг зар засвар <small>нэмэх, засах</small></h2>
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
                        <form id="news-manager-form" method="POST" action="{{config('path_config.APP_PATH')}}/administrator/marquee/marqueeActionManagerDAO" onsubmit="return validateLinkForm(this);" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="marqueeID">Гүйдэг зар ID <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="marqueeID" id="marqueeID" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="marqueeName">Гүйдэг зар нэр <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="marqueeName" name="marqueeName" required="required" class="form-control col-md-7 col-xs-12" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="marqueeValue" class="control-label col-md-3 col-sm-3 col-xs-12">Гүйдэг зар утга </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="marqueeValue" name="marqueeValue" required="required" class="form-control col-md-7 col-xs-12" maxlength="200">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="marqueePosition" class="control-label col-md-3 col-sm-3 col-xs-12">Гүйдэг зар байрлал </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="marqueePosition" id="marqueePosition">
                                        <option value="none">- сонгох -</option>
                                        <option value="top">дээд</option>
                                        <option value="middle">дунд</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="marqueeDeadline" class="control-label col-md-3 col-sm-3 col-xs-12">Гүйдэг зар дуусах хугацаа </label>
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                                <input type="text" class="form-control has-feedback-left" name="marqueeDeadline" id="single_cal2" readonly="readonly" placeholder="хугацаа сонго" aria-describedby="inputSuccess2Status2">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="form-group">
                                <label for="marqueeActive" class="control-label col-md-3 col-sm-3 col-xs-12">Гүйдэг зар идэвхтэй </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" checked="" value="1" id="marqueeActive01" name="marqueeActive"> идэвхтэй
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="0" id="marqueeActive02" name="marqueeActive"> идэвхгүй
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="marqueeActionTypeHidden" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="marqueeActionTypeHidden" id="marqueeActionTypeHidden" readonly="" required="" value="create"/>
                                    <input type="hidden" name="marqueeActionCodeHidden" id="marqueeActionCodeHidden" readonly=""/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" readonly="">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">болих</button>
                                    <button class="btn btn-primary" type="reset">сэргээх</button>
                                    <button type="submit" name="marqueeManagerSaveBtn" id="marqueeManagerSaveBtn" class="btn btn-success">хадгалах</button>
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
                        <h2>Өмнөх Гүйдэг зар <small>харах, засах, устгах</small></h2>
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
                            Гүйдэг зарын арын үйлдэл товч дээрээ засах, устгах, харах үйлдэл хийж болно
                        </p>
                        {!! printMarqueeTable() !!}
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