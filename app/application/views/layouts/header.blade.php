<!DOCTYPE html>
<!--[if IEMobile 7]><html class="no-js iem7" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#"><![endif]-->
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8 ie7" lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9 ie8" lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie" lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--> <html class="no-js" lang="en" xmlns="http://www.w3.org/1999/xhtml"  xmlns:fb="http://ogp.me/ns/fb#"><!--<![endif]-->
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# 
                  website: http://ogp.me/ns/website#">

	<!-- Force latest IE rendering engine or ChromeFrame if installed -->
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
	<meta charset="utf-8">
	<title>{{ ( isset($title) ? $title : Config::get('application.site_title') ) . ' | ' . Config::get('application.site_name') }}</title>
	<meta name="description" content="{{ Config::get('application.site_name') . ' | ' . Config::get('application.site_title') }}">
	<meta name="author" content="AA">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta property="og:url" content="http://o2internationalevents.co.uk/ecard">
	<meta property="og:type" content="{{ isset( $type ) ? $type : 'website' }}">
	<meta property="og:title" content="{{ ( isset($title) ? $title : Config::get('application.site_title') ) . ' | ' . Config::get('application.site_name') }}">
	<meta property="og:description" content="{{ Config::get('application.share_copy') }}">
	<meta property="og:image" content="{{ isset( $thumb ) ? URL::to_asset($thumb) : URL::to_asset('img/thumb.png') }}">
	<meta property="og:site_name" content="{{ Config::get('application.site_name') }}">

	<link rel="shortcut icon" href="{{ URL::to_asset('favicon.jpg') }}">

	<meta http-equiv="cleartype" content="on">
	<link rel="canonical" href="{{ URL::current() }}">

	{{ HTML::style('css/normalize.min.css') }}
	{{ HTML::style('css/style.css') }}
	{{ HTML::script('js/vendor/modernizr-2.6.2.min.js') }}

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!--Load jQuery-->
	<script>window.jQuery || document.write(unescape('%3Cscript src="{{ URL::to_asset('js/vendor/jquery-1.9.1.min.js') }}"%3E%3C/script%3E'))</script>
	<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
	<body>
		<!--[if lt IE 7]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->
	
	<div id="container">
		<div id="wrapper">
	