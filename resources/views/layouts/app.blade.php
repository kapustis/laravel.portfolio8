<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
