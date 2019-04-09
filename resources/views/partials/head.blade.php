<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@yield('title') | JMP</title>

{{-- Preloads --}}
<link rel="preload" href="{{ mix('/css/index.css') }}" as="style" type="text/css">
<link rel="preload" href="https://fonts.googleapis.com/css?family=Titillium+Web:400,400i,600,700" as="style" type="text/css">
<link rel="preload" href="{{ asset('fonts/fa-solid-900.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="{{ asset('fonts/fa-regular-400.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
{{-- <link rel="preload" href="{{ asset('fonts/fa-brands-400.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous"> --}}
@stack('head-preload')


{{-- Fonts --}}
<link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,400i,600,700" rel="stylesheet" type="text/css">


{{-- Styles --}}
<link rel="stylesheet" href="{{ mix('/css/index.css') }}">
@stack('head-styles')


{{-- Scripts --}}
<script src="{{ mix('/js/alert-toggle.js') }}" defer></script>
@stack('head-scripts')

{{-- Google Tag Manager --}}
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{{ env('GTM_ID') }}');</script>
{{-- End Google Tag Manager --}}


{{-- Favicons + Meta --}}
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
<meta name="application-name" content="{{ config('app.name') }}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{ asset('images/favicons/mstile-144x144.png') }}">
<meta name="msapplication-square70x70logo" content="{{ asset('images/favicons/mstile-70x70.png') }}">
<meta name="msapplication-square150x150logo" content="{{ asset('images/favicons/mstile-150x150.png') }}">
<meta name="msapplication-wide310x150logo" content="{{ asset('images/favicons/mstile-310x150.png') }}">
<meta name="msapplication-square310x310logo" content="{{ asset('images/favicons/mstile-310x310.png') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="JMP Industries custom tailors product lines using advanced materials, cost effective designs, and unmatched craftsmanship.">
@stack('head-meta')


{{-- Prefetch --}}
@stack('head-prefetch')
