
@if ($type === '01')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Ерөнхий мэдээлэл удирдах хуудас</h3>
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
                        <h2>Ерөнхий мэдээлэл засвар <small> засах</small></h2>
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
                        <form id="news-manager-form" method="POST" action="/administrator/general-info/generalInfoActionManagerDAO" onsubmit="return validateLinkForm(this);" data-parsley-validate class="form-horizontal form-label-left">

                            {!! printGeneralInfoFormElements() !!}
                            <!--
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="generalInfoID">Ерөнхий мэдээ ID <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="generalInfoID" id="generalInfoID" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="generalInfoPageTitle">Веб хуудасны нэр <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="generalInfoPageTitle" name="generalInfoPageTitle" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="generalInfoHeaderPicture" class="control-label col-md-3 col-sm-3 col-xs-12">Толгой зураг </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="generalInfoHeaderPicture" name="generalInfoHeaderPicture" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="generalInfoPageFavicon" class="control-label col-md-3 col-sm-3 col-xs-12">Веб хуудасны дүрс </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="generalInfoPageFavicon" name="generalInfoPageFavicon" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="generalInfoYoutubeURL" class="control-label col-md-3 col-sm-3 col-xs-12">Youtube URL </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="generalInfoYoutubeURL" name="generalInfoYoutubeURL" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="generalInfoFacebookURL" class="control-label col-md-3 col-sm-3 col-xs-12">Facebook URL </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="generalInfoFacebookURL" name="generalInfoFacebookURL" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="generalInfoGoogleGPS" class="control-label col-md-3 col-sm-3 col-xs-12">Google GPS Coordinate </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="generalInfoGoogleGPS" name="generalInfoGoogleGPS" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="generalInfoPhoneNumbers" class="control-label col-md-3 col-sm-3 col-xs-12">Холбоо барих дугаар </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="generalInfoPhoneNumbers" name="generalInfoPhoneNumbers" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="generalInfoGreeting" class="control-label col-md-3 col-sm-3 col-xs-12">Мэндчилгээ </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="generalInfoGreeting" name="generalInfoGreeting" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="generalInfoAddress" class="control-label col-md-3 col-sm-3 col-xs-12">Хаяг </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="generalInfoAddress" name="generalInfoAddress" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="generalInfoFax" class="control-label col-md-3 col-sm-3 col-xs-12">Факс </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="generalInfoFax" name="generalInfoFax" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="generalInfoEmail" class="control-label col-md-3 col-sm-3 col-xs-12">э-мэйл </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="generalInfoEmail" name="generalInfoEmail" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="generalInfoActionTypeHidden" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="generalInfoActionTypeHidden" id="generalInfoActionTypeHidden" readonly="" required="" value="edit"/>
                                    <input type="hidden" name="generalInfoActionCodeHidden" id="generalInfoActionCodeHidden" readonly=""/>
                                </div>
                            </div>
                            -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" readonly="">
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">болих</button>
                                    <button class="btn btn-primary" type="reset">сэргээх</button>
                                    <button type="submit" name="generalInfoManagerSaveBtn" id="generalInfoManagerSaveBtn" class="btn btn-success">хадгалах</button>
                                </div>
                            </div>

                        </form>
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