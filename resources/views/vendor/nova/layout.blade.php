<!DOCTYPE html>
<html lang="en" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1280">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Nova::name() }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'nova-assets') }}">

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
    <meta name="application-name" content="{{ Nova::name() }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('images/favicons/mstile-144x144.png') }}">
    <meta name="msapplication-square70x70logo" content="{{ asset('images/favicons/mstile-70x70.png') }}">
    <meta name="msapplication-square150x150logo" content="{{ asset('images/favicons/mstile-150x150.png') }}">
    <meta name="msapplication-wide310x150logo" content="{{ asset('images/favicons/mstile-310x150.png') }}">
    <meta name="msapplication-square310x310logo" content="{{ asset('images/favicons/mstile-310x310.png') }}">

    <!-- Tool Styles -->
    @foreach(Nova::availableStyles(request()) as $name => $path)
        <link rel="stylesheet" href="/nova-api/styles/{{ $name }}">
    @endforeach

    <style>
        :root {
            --logo: #ffffff;
        }
    </style>
</head>
<body class="min-w-site bg-40 text-black min-h-full">
    <div id="nova">
        <div v-cloak class="flex min-h-screen">
            <!-- Sidebar -->
            <div class="min-h-screen flex-none pt-header min-h-screen w-sidebar bg-grad-sidebar px-6">
                <a href="{{ Nova::path() }}">
                    <div class="absolute pin-t pin-l pin-r bg-logo flex items-center w-sidebar h-header px-6 text-white border-r border-50">
                       @include('nova::partials.logo')
                    </div>
                </a>

                @foreach (Nova::availableTools(request()) as $tool)
                    {!! $tool->renderNavigation() !!}
                @endforeach
            </div>

            <!-- Content -->
            <div class="content">
                <div class="flex items-center relative shadow h-header bg-white z-50 px-6">
                    <a href="{{ Config::get('nova.url') }}" class="no-underline dim font-bold text-90 mr-6">
                        {{ Nova::name() }}
                    </a>

                    @if (count(Nova::globallySearchableResources(request())) > 0)
                        <global-search></global-search>
                    @endif

                    <dropdown class="ml-auto h-9 flex items-center" style="right: 20px">
                        @include('nova::partials.user')
                    </dropdown>
                </div>

                <div data-testid="content" class="px-view py-view mx-auto">
                    @yield('content')

                    <p class="mt-8 text-center text-xs text-80">
                        <a href="http://nova.laravel.com" class="text-primary dim no-underline">Laravel Nova</a>
                        <span class="px-1">&middot;</span>
                        &copy; {{ date('Y') }} Laravel LLC - By Taylor Otwell, David Hemphill, and Steve Schoger.
                        <span class="px-1">&middot;</span>
                        v{{ Laravel\Nova\Nova::version() }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.config = @json(Nova::jsonVariables(request()));
    </script>

    <!-- Scripts -->
    <script src="{{ mix('manifest.js', 'nova-assets') }}"></script>
    <script src="{{ mix('vendor.js', 'nova-assets') }}"></script>
    <script src="{{ mix('app.js', 'nova-assets') }}"></script>

    <!-- Build Nova Instance -->
    <script>
        window.Nova = new CreateNova(config)
    </script>

    <!-- Tool Scripts -->
    @foreach (Nova::availableScripts(request()) as $name => $path)
        @if (starts_with($path, ['http://', 'https://']))
            <script src="{!! $path !!}"></script>
        @else
            <script src="/nova-api/scripts/{{ $name }}"></script>
        @endif
    @endforeach

    <!-- Start Nova -->
    <script>
        Nova.liftOff()
    </script>
</body>
</html>
