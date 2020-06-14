@extends('administrator.layouts.main_admin')

@section('title', 'Admin Index Page')

@section('admin_head')
@include('administrator.sections.sec_admin_head', ['type' => '01'])
@stop

@section('admin_leftbar')
@include('administrator.sections.sec_admin_leftbar', ['type' => '01'])
@stop

@section('admin_topbar')
@include('administrator.sections.sec_admin_topbar', ['type' => '01'])
@stop

@section('admin_rightbar')
@include('administrator.sections.sec_admin_rightbar', ['page_type' => $page_type])
@stop

@section('admin_footer')
@include('administrator.sections.sec_admin_footer', ['type' => '01'])
@stop

@section('admin_javascript')
@include('administrator.sections.sec_admin_javascript', ['type' => '01'])
@stop

@section('admin_user_javascript')
@include('administrator.sections.sec_admin_user_javascript', ['page_type' => $page_type])
@stop
