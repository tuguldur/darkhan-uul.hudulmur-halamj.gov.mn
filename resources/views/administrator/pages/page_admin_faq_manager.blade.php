
@if ($type === '01')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Тогтмол асуудаг асуултууд удирдах хуудас</h3>
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
                        <h2>Асуулт засвар <small>нэмэх, засах</small></h2>
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
                        <form id="news-manager-form" method="POST" action="/administrator/faq/faqActionManagerDAO" onsubmit="return validateFaqForm(this);" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="faqID">Асуулт ID <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="faqID" id="faqID" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="faqTitle">Асуулт гарчиг <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="faqTitle" name="faqTitle" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="faqContent" class="control-label col-md-3 col-sm-3 col-xs-12">Асуулт агуулга </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="faqContent" name="faqContent" class="resizable_textarea form-control" placeholder="энэ талбарт мэдээний бүтэн агуулга бичнэ үү..."></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="faqViewCount">Асуулт үзсэн </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="faqViewCount" name="faqViewCount" class="form-control col-md-7 col-xs-12" maxlength="7" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Асуулт идэвхтэй </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" checked="" value="1" id="faqActive01" name="faqActive"> идэвхтэй
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" value="0" id="faqActive02" name="faqActive"> идэвхгүй
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="faqActionTypeHidden" id="faqActionTypeHidden" readonly="" required="" value="create"/>
                                    <input type="hidden" name="faqActionCodeHidden" id="faqActionCodeHidden" readonly=""/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" readonly="">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">болих</button>
                                    <button class="btn btn-primary" type="reset">сэргээх</button>
                                    <button type="submit" name="faqManagerSaveBtn" id="faqManagerSaveBtn" class="btn btn-success">хадгалах</button>
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
                        {!! printFAQsTable() !!}
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