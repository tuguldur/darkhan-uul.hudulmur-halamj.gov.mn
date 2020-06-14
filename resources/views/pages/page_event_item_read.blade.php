@extends('layouts.main')

@section('title', 'Index Page')

@section('facebook_og_tags')
@include('sections.sec_facebook_og_tags', ['page_type' => 'single_event_read'])
@stop

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
@include('sections.sec_page_info', ['type' => '02'])
@stop

@section('page_container')
@include('sections.sec_page_container', ['type' => '01', 'page_type' => 'single_event_read'])
@stop

@section('main_footer')
@include('sections.sec_main_footer', ['type' => '01'])
@stop

@section('javascript')
@include('sections.sec_javascript', ['type' => '01'])
@stop