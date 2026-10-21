<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Лабораторний практикум')</title>
</head>
<body>
  <nav>
    <a href="{{ route('site.say') }}">Головна</a>
    <a href="{{ route('site.about') }}">Про застосунок</a>
    <a href="{{ route('site.contact') }}">Контакти</a>
    <a href="{{ route('entry.form') }}">Форма</a>
    <a href="{{ route('realty.page') }}">Нерухомість</a>
    <a href="{{ route('country.index') }}">Країни</a>
    <a href="{{ route('apartment.index') }}">Каталог квартир</a>
</nav>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} КПІ ім. Ігоря Сікорського Лаба1
    </footer>
</body>
</html>