<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="{{url('public')}}/img/logo.png" type="image/png">
	<title>UK Fashion Shop - {{$PageTitle ?? 'Home'}}</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{url('public/css')}}/bootstrap.css">
	<link rel="stylesheet" href="{{url('public/assets')}}/linericon/style.css">
	<link rel="stylesheet" href="{{url('public/css')}}/font-awesome.min.css">
	<link rel="stylesheet" href="{{url('public/assets')}}/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="{{url('public/assets')}}/lightbox/simpleLightbox.css">
	<link rel="stylesheet" href="{{url('public/assets')}}/animate-css/animate.css">
	<link rel="stylesheet" href="{{url('public/assets')}}/jquery-ui/jquery-ui.css">
	<link href="https://fonts.googleapis.com/css2?family=Mulish&family=Poppins&display=swap" rel="stylesheet">
	<!-- main css -->
	<link rel="stylesheet" href="{{url('public/css')}}/style.css">
	<link rel="stylesheet" href="{{url('public/css')}}/print.css">
	<link rel="stylesheet" href="{{url('public/css')}}/responsive.css">
	<!-- Advanced Meta Tags -->
	@auth
	<meta name="user_id" content="{{auth()->user()->id}}">
	@endauth
	<meta name="base_url" content="https://ukfashionshop.eu">
	<meta name="csrf_token" content="{{ csrf_token() }}" />
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-NNKF843');
	</script>
	<!-- End Google Tag Manager -->
</head>
