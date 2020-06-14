
@if ($type === '01')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Санал, хүсэлт, гомдол удирдах хуудас</h3>
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
                        <h2>Санал, хүсэлт, гомдол <small>харах</small></h2>
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
                        <form id="news-manager-form" method="POST" action="/administrator/complaint/complaintActionManagerDAO" onsubmit="return validateComplaintForm(this);" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="complaintID">дугаар <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="complaintID" id="complaintID" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="complaintPersonName">Нэр <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="complaintPersonName" name="complaintPersonName" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="complaintPersonRegister">Регистр <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="complaintPersonRegister" name="complaintPersonRegister" readonly="readonly" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="complaintPersonEmail" class="control-label col-md-3 col-sm-3 col-xs-12">э-мэйл </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="complaintPersonEmail" name="complaintPersonEmail" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="complaintText" class="control-label col-md-3 col-sm-3 col-xs-12">бичвэр </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="complaintText" name="complaintText" class="resizable_textarea form-control" placeholder="" rows="20"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="complaintPersonPhone" class="control-label col-md-3 col-sm-3 col-xs-12">утас </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="complaintPersonPhone" name="complaintPersonPhone" required="required" class="form-control col-md-7 col-xs-12" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="complaintType" class="control-label col-md-3 col-sm-3 col-xs-12">төрөл </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="complaintType" name="complaintType">
                                        <option value="none"> - сонгох - </option>
                                        <option value="1">санал</option>
                                        <option value="2">гомдол</option>
                                        <option value="3">хүсэлт</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="complaintSubmittedAt" class="control-label col-md-3 col-sm-3 col-xs-12">ирсэн хугацаа </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="complaintSubmittedAt" name="complaintSubmittedAt" required="required" readonly="readonly" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="complaintActionTypeHidden" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="complaintActionTypeHidden" id="complaintActionTypeHidden" readonly="" required="" value="create"/>
                                    <input type="hidden" name="complaintActionCodeHidden" id="complaintActionCodeHidden" readonly=""/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" readonly="">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">болих</button>
                                    <button class="btn btn-primary" type="reset">сэргээх</button>
                                    <button type="submit" name="complaintManagerSaveBtn" id="complaintManagerSaveBtn" class="btn btn-success">хадгалах</button>
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
                        <h2>Санал, хүсэлт, гомдол <small>харах, засах, устгах</small></h2>
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
                            Доорх санал, хүсэлт, гомдол -н арын үйлдэл товч дээр дарж устгах, харах үйлдэл хийж болно.
                            <span class='label label-warning'>санал, хүсэлт, гомдол -г уншиж төрлийг сонгоод хадгалах үед шалгасан төлөвтэй болно.</span>
                        </p>
                        {!! printComplaintsRequestsTable() !!}
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