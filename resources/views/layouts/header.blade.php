<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Ibtikarat | Dashboard') }}</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
	<meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- responsive style -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">
  <!-- Fontastic Custom icon font-->
  <link rel="stylesheet" href="{{ asset('css/fontastic.css') }}">
  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="{{ asset('css/style.default.css') }}" id="theme-stylesheet">

  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

	<link href="{{ asset('css/print.min.css') }}" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

  <!-- Favicon-->
  <link rel="shortcut icon" href="#">
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

	<script src="{{ asset('js/print.min.js') }}" type="text/javascript"></script>

  <script src="{{ asset('js/libraries/js/amcharts.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/libraries/js/serial.js') }}" type="text/javascript"></script>

  <!-- amCharts plugins -->
  <script type="text/javascript" src="{{ asset('js/libraries/js/plugins/export/export.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('js/libraries/js/plugins/export/export.css') }}">


  <!-- Morris javascript sources -->
  <script src="{{ asset('js/libraries/custom/components/charts/morris-charts.js') }}" type="text/javascript"></script>

</head>
