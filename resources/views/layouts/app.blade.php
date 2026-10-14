<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Лабораторний практикум')</title>
</head>
<body>
    <nav>
        <a href="{{ url('/') }}">Головний прикол</a>
        <a href="{{ url('/about') }}">Про стосунок</a>
        <a href="{{ url('/contact') }}">Контракти</a>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} КПІ ім. Ігоря Сікорського Лаба1
    </footer>
</body>
</html>