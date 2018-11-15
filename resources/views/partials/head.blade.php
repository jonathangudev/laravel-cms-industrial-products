<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@yield('title')</title>

{{-- Preloads --}}
<link rel="preload" href="{{ mix('/css/index.css') }}" as="style" type="text/css">
<link rel="preload" href="https://fonts.googleapis.com/css?family=Titillium+Web:400,400i,600,700" as="style" type="text/css">
<link rel="preload" href="{{ asset('fonts/fa-regular-400.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="{{ asset('fonts/fa-solid-900.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
{{-- <link rel="preload" href="{{ asset('fonts/fa-brands-400.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous"> --}}
@yield('head-preload-content')


{{-- Fonts --}}
<link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,400i,600,700" rel="stylesheet" type="text/css">


{{-- Styles --}}
<link rel="stylesheet" href="{{ mix('/css/index.css') }}">


{{-- Favicons --}}
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('images/favicons/apple-touch-icon-57x57.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/favicons/apple-touch-icon-114x114.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/favicons/apple-touch-icon-72x72.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/favicons/apple-touch-icon-144x144.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('images/favicons/apple-touch-icon-60x60.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('images/favicons/apple-touch-icon-120x120.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('images/favicons/apple-touch-icon-76x76.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('images/favicons/apple-touch-icon-152x152.png') }}">
<link rel="icon" type="image/png" href="{{ asset('images/favicons/favicon-196x196.png') }}" sizes="196x196">
<link rel="icon" type="image/png" href="{{ asset('images/favicons/favicon-96x96.png') }}" sizes="96x96">
<link rel="icon" type="image/png" href="{{ asset('images/favicons/favicon-32x32.png') }}" sizes="32x32">
<link rel="icon" type="image/png" href="{{ asset('images/favicons/favicon-16x16.png') }}" sizes="16x16">
<link rel="icon" type="image/png" href="{{ asset('images/favicons/favicon-128.png') }}" sizes="128x128">
<meta name="theme-color" content="#ffffff">
<meta name="application-name" content="JMP Industries Inc.">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{ asset('images/favicons/mstile-144x144.png') }}">
<meta name="msapplication-square70x70logo" content="{{ asset('images/favicons/mstile-70x70.png') }}">
<meta name="msapplication-square150x150logo" content="{{ asset('images/favicons/mstile-150x150.png') }}">
<meta name="msapplication-wide310x150logo" content="{{ asset('images/favicons/mstile-310x150.png') }}">
<meta name="msapplication-square310x310logo" content="{{ asset('images/favicons/mstile-310x310.png') }}">

@yield('head-content')
