@extends('layouts.main')

@section('title', 'Index Page')

@section('head')
@include('sections.sec_head', ['type' => '01'])
@stop

@section('main_header')
@include('sections.sec_main_header', ['type' => '01'])
@stop

{{--
@section('page_title')
@include('sections.sec_page_title', ['type' => '00'])
@stop
--}}

@section('page_info')
@include('sections.sec_page_info', ['type' => '01'])
@stop

@section('page_container')
@include('sections.sec_page_container', ['type' => '01', 'page_type' => 'single_item'])
@stop

@section('main_footer')
@include('sections.sec_main_footer', ['type' => '01'])
@stop

@section('javascript')
@include('sections.sec_javascript', ['type' => '01'])
@stop

@section('user_javascript')
@include('sections.sec_user_javascript', ['page' => 'menu_item_read_news', 'postID' => $postID, 'menuID' => $menuID])
@stop
