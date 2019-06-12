<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | @yield('title', 'الرئيسية')</title>

    <meta name="description" content="Free web tutorials">
    <meta name="keywords" content="@yield('keywords')">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('public/cpanel/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/cpanel/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('public/cpanel/css/ionicons.min.css')}}">
    <!-- DataTables -->
    {{--<link rel="stylesheet" href="{{asset('public/cpanel/css/dataTables.bootstrap.css')}}">--}}
    <link rel="stylesheet" href="{{asset('public/cpanel/css/jquery.dataTables.css')}}">
    <link rel="stylesheet" href="{{asset('public/cpanel/css/buttons.dataTables.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('public/cpanel/css/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/cpanel/css/AdminLTE-RTL.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('public/cpanel/css/_all-skins.min.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('public/cpanel/css/bootstrap3-wysihtml5.min.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="{{asset('public/cpanel/css/video-js.css')}}" rel="stylesheet" type="text/css">


@yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <![endif]-->
</head>