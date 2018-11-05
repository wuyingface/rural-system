<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '村村汇') - {{ setting('site_name', '村村汇') }}</title>
    <meta name="description" content="@yield('description', '村村汇')" />
    <meta name="description" content="@yield('description', setting('seo_description', '广东省农村信息收集分享平台'))" />
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', '广东省,新农村,信息收集,文化建设,社会主义新农村,美丽乡村,乡村信息'))" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <div id="app" class="{{ route_class() }}-page">

        @include('layouts._header')

        <div class="container">

            @include('layouts._message')
            @yield('content')

        </div>

        @include('layouts._footer')
    </div>

    @if (app()->isLocal())
        @include('sudosu::user-selector')
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>