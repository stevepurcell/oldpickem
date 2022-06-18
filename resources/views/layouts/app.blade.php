<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layouts._head')
<body>
    <div id="app">
        @include('layouts._navbar')

        @include('layouts.countdown')
        @include('flash-message')

        <main class="py-1">
            @yield('content')
        </main>
    </div>
</body>
</html>
