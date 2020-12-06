<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
    <!-- Styles -->
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    <script>
        window.default_locale = "{{ app()->getLocale() }}";
        window.fallback_locale = "{{ app()->getLocale() }}";
        {{--window.messages = @json($messages);--}}
            window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),'user' => Auth::user(),'signedIn' => Auth::check()]) !!};
    </script>
</head>
<body>
<div id="app">
    @include('includes.header')
    @yield('content')
    <flash message="{{session('flash')}}"></flash>
    @include('includes.footer')
</div>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
