
@if ($type === '01')

<!-- page content -->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Мэдээ цэс шилжүүлэх хуудас</h3>
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
                        <h2>Мэдээ цэс шилжүүлэх хэсэг <small></small> </h2>
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
                        <form id="menu-manager-form" method="POST" action="/administrator/menu/menuActionTransfer" onsubmit="return validateMenuTransferForm(this);" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuTreeList">Шилжүүлэх цэсийг сонго: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! printNewsMenuAdminPage() !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12"> </label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <span class="label label-info" style="font-size: 14px;">1. Цэс шилжүүлэхдээ дээр байгаа цэсүүдээс шилжүүлэх нэг цэсийг эхлээд сонгоно. <br/>2. Үүний дараа доор байгаа цэсүүдээс нэгийг сонгож хадгалвал <br/>дээр сонгосон цэс доор сонгосон цэсийн дэд цэс болж хадгалагдах болно.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuTreeList">хүлээн авах цэсийг сонго: <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! printNewsMenuAdminPage02() !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="movingMenuID" id="movingMenuID" readonly="readonly" required="required"/>
                                    <input type="hidden" name="receivingMenuID" id="receivingMenuID" readonly="readonly"/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" readonly="">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">болих</button>
                                    <button class="btn btn-primary" type="reset">сэргээх</button>
                                    <button type="submit" name="menuTransferSaveBtn" id="menuTransferSaveBtn" class="btn btn-success">хадгалах</button>
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