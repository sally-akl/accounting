<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{ config('app.name', 'Ibtikarat | Dashboard') }}</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
				google: {
					"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
				},
				active: function() {
					sessionStorage.fonts = true;
				}
			});
		</script>

		<!--end::Web font <link href="{{ asset('css/bootstrap-4.css') }}" rel="stylesheet" type="text/css" />-->

		<!--begin::Base Styles -->

		<link href="{{ asset('css/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />

		<link href="{{ asset('css/bootstrap-4.css') }}" rel="stylesheet" type="text/css" />

		<link href="{{ asset('css/styleDashboard.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/print.min.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">


		<!-- amCharts javascript sources -->
		<link rel="stylesheet" href="{{ asset('style.css') }}" type="text/css">
    <script src="{{ asset('js/libraries/js/amcharts.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/libraries/js/serial.js') }}" type="text/javascript"></script>

		<!-- amCharts plugins -->
		<script type="text/javascript" src="{{ asset('js/libraries/js/plugins/export/export.js') }}"></script>
		<link rel="stylesheet" href="{{ asset('js/libraries/js/plugins/export/export.css') }}">

		<!-- Morris javascript sources -->
		<script src="{{ asset('js/libraries/custom/components/charts/morris-charts.js') }}" type="text/javascript"></script>

	<script src="{{ asset('js/print.min.js') }}" type="text/javascript"></script>

	

	</head>
	<!-- end::Head -->
