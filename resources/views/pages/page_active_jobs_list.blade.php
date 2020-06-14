@extends('layouts.main')

@section('title', 'Index Page')

@section('head')
@include('sections.sec_head', ['type' => '01'])
@stop

@section('main_header')
@include('sections.sec_main_header', ['type' => '01'])
@stop

@section('page_container')
@include('sections.sec_page_container', ['type' => '01', 'page_type' => 'active_jobs_list'])
@stop

@section('main_footer')
@include('sections.sec_main_footer', ['type' => '01'])
@stop

@section('javascript')
@include('sections.sec_javascript', ['type' => '01'])
@stop