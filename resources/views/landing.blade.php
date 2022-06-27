<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/x-icon" href="{{ asset('favicon.svg') }}">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous"/>
		<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
		<title>{{ __('Job Listings') }}</title>
	</head>
	<body class="bg-neutral-100">
		@if(session()->has('message'))
		<div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show" x-transition:enter.duration.0ms x-transition:leave.duration.300ms
		class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-emerald-700 text-white font-bold py-4 px-32">
			{{session('message')}}
		</div>
		@endif
		<x-navbar/>
        <x-searchbar/>
		<x-landing_offers :offers='$offers'/>
	</body>
</html>
