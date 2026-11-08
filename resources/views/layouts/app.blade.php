<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Лабораторний практикум')</title>

    <!-- Підключення jQuery та Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
    <a href="{{ route('stats.pages') }}">Статистика</a>
    <a href="{{ route('blog.index') }}">Блог</a>
</nav>

    <main>
        @yield('content')
    </main>

    <footer>
    <hr>
    &copy; {{ date('Y') }} КПІ ім. Ігоря Сікорського | Студент: Пащенко Є.О., група РІ-31
</footer>
<script>
        $(document).ready(function() {
            $('#filters').select2({
                placeholder: "Оберіть мітки",
                allowClear: true
            });
        });
    </script>
</body>
</html>