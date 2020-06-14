@extends('layouts.main')

@section('title', 'Нүүр хуудас')

@section('head')
@include('sections.sec_head', ['type' => '01'])
@stop

@section('main_header')
@include('sections.sec_main_header', ['type' => '01'])
@stop

@section('main_slider')
@include('sections.sec_main_slider', ['type' => '01'])
@stop

@section('main_services')
@include('sections.sec_main_services', ['type' => '01'])
@stop

@section('front_about')
@include('sections.sec_front_about', ['type' => '01'])
@stop

@section('sponsers')
@include('sections.sec_sponsers', ['type' => '01'])
@stop

{{--
@section('causes')
@include('sections.sec_causes', ['type' => '01'])
@stop
--}}

{{--
@section('call_action')
@include('sections.sec_call_action', ['type' => '01'])
@stop
--}}

{{--
@section('volunteers')
@include('sections.sec_volunteers', ['type' => '01'])
@stop
--}}

{{--
@section('client_says')
@include('sections.sec_client_says', ['type' => '01'])
@stop
--}}

@section('main_events')
@include('sections.sec_main_events', ['type' => '01'])
@stop

@section('main_footer')
@include('sections.sec_main_footer', ['type' => '01'])
@stop

@section('javascript')
@include('sections.sec_javascript', ['type' => '01'])
@stop

@section('user_javascript')
@include('sections.sec_user_javascript', ['page' => 'welcome_page'])
@stop