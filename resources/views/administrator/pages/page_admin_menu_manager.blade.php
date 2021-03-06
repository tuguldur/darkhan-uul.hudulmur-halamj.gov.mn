
@if ($type === '01')

<!-- page content -->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Мэдээ цэс удирдах хуудас</h3>
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
                        <h2>Мэдээ цэс засвар <small>нэмэх, засах</small> <span class="label label-info"><a href="/administrator/guide/news_manager/" target="_blank">мэдээ оруулах заавар үзэх</a></span></h2>
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
                        <form id="menu-manager-form" method="POST" action="/administrator/menu/menuActionManagerDAO" enctype="multipart/form-data" onsubmit="return validateMenuForm(this);" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuTreeList">Цэс жагсаалт <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! printNewsMenuAdminPage() !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuID">Цэс ID <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="menuID" id="menuID" required="required" class="form-control col-md-7 col-xs-12" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuName">Цэс нэр <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="menuName" name="menuName" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menuURL">Цэс URL 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="menuURL" name="menuURL" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="menuIsClickable01" class="control-label col-md-3 col-sm-3 col-xs-12">Товшдог цэс үү? </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" checked="" value="1" id="menuIsClickable01" name="menuIsClickable"> тийм, Товшиж болно
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="0" id="menuIsClickable02" name="menuIsClickable"> үгүй, Товшиж болохгүй
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="menuActive01" class="control-label col-md-3 col-sm-3 col-xs-12">Цэс төлөв </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" checked="" value="1" id="menuActive01" name="menuActive"> идэвхтэй
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="0" id="menuActive02" name="menuActive"> идэвхгүй
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="parentMenuIDHidden" id="parentMenuIDHidden" readonly="readonly" required="required"/>
                                    <input type="hidden" name="menuActionTypeHidden" id="menuActionTypeHidden" readonly="readonly" required="required" value="create"/>
                                    <input type="hidden" name="menuActionCodeHidden" id="menuActionCodeHidden" readonly="readonly"/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" readonly="">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">болих</button>
                                    <button class="btn btn-primary" type="reset">сэргээх</button>
                                    <button type="submit" name="menuManagerSaveBtn" id="menuManagerSaveBtn" class="btn btn-success">хадгалах</button>
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
                        <h2>Дэд цэсүүд <small>харах, засах, устгах</small></h2>
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
                            Дээрх цэсүүдийн жагсаалтаас эхэлж нэг цэсийг сонгож доорх хүснэгтэд гарч ирсэн дэд цэсүүдийн арын үйлдэл товч дээрээ засах, устгах, харах үйлдэл хийж болно.
                        </p>
                        <div id="subMenusTableContainer">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Дэд цэсүүд дараалалд оруулах</h2>
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
                            Доорх цэсүүдийн дээш, доош чирж өөрийн хүссэн зөв дараалалд оруулж болно.
                        </p>
                        <style type="text/css">
                            .draggable 
                            { 
                                background: #fff; 
                                padding-bottom: 10px; 
                                padding-top: 10px; 
                                padding-right: 0px; 
                                padding-left: 0px; 
                                cursor: move;
                                border: #000 1px solid;
                                text-align: center;
                                font-weight: bold
                            }
                            .droppable 
                            { 
                                width: 550px;
                                background-color: #F93;
                                list-style: none;
                                margin: 0;
                                padding: 10px;
                                height: 100%;
                            }
                        </style>
                        <div id = "divMain">
                            <div id="divOuter1" class="droppable">

                            </div>
                        </div>
                        <button name="btnSaveMenuOrdering" id="btnSaveMenuOrdering" class="btn btn-primary">дараалалыг хадгалах</button>
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