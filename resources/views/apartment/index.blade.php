@extends('layouts.app')

@section('title', $currentLocale === 'en' ? 'Property Catalog' : 'Каталог квартир')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>{{ $currentLocale === 'en' ? 'Real Estate Catalog' : 'Каталог нерухомості' }}</h1>

        <!-- Перемикач мови (пункт 5) -->
        <div style="font-size: 15px;">
            <strong>Мова / Language:</strong>
            <a href="{{ request()->fullUrlWithQuery(['lang' => 'uk']) }}" style="{{ $currentLocale === 'uk' ? 'font-weight: bold; text-decoration: underline;' : '' }}">🇺🇦 UK</a> | 
            <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}" style="{{ $currentLocale === 'en' ? 'font-weight: bold; text-decoration: underline;' : '' }}">🇬🇧 EN</a>
        </div>
    </div>

    <p>
        <a href="{{ route('apartment.create') }}">+ {{ $currentLocale === 'en' ? 'Add new property' : 'Додати нову квартиру' }}</a>
    </p>

    <!-- Форма фільтрації за містом -->
    <form method="GET" action="{{ route('apartment.index') }}" style="margin-bottom: 20px; padding: 10px; background: #f0f0f0; display: inline-block;">
        <input type="hidden" name="lang" value="{{ $currentLocale }}">
        <label for="filter_city"><strong>{{ $currentLocale === 'en' ? 'Filter by city:' : 'Фільтр за містом:' }}</strong></label>
        <input type="text" id="filter_city" name="city" value="{{ request('city') }}" placeholder="{{ $currentLocale === 'en' ? 'Kyiv, Lviv...' : 'Наприклад: Київ, Львів' }}">
        <button type="submit">{{ $currentLocale === 'en' ? 'Search' : 'Шукати' }}</button>
        @if(request('city'))
            <a href="{{ route('apartment.index', ['lang' => $currentLocale]) }}" style="margin-left: 10px;">{{ $currentLocale === 'en' ? 'Reset' : 'Скинути фільтр' }}</a>
        @endif
    </form>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 850px;">
        <thead>
            <tr style="background: #e9ecef;">
                <th>#</th>
                <th>{{ $currentLocale === 'en' ? 'Title' : 'Назва' }}</th>
                <th>{{ $currentLocale === 'en' ? 'City' : 'Місто' }}</th>
                <th>{{ $currentLocale === 'en' ? 'Rooms' : 'Кімнат' }}</th>
                <th>{{ $currentLocale === 'en' ? 'Price ($)' : 'Ціна ($)' }}</th>
                <th>{{ $currentLocale === 'en' ? 'Actions' : 'Дії' }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($apartments as $apt)
                @php
                    $translation = $apt->translation($currentLocale);
                @endphp
                <tr>
                    <td>{{ $apt->id }}</td>
                    <td>
                        <a href="{{ route('apartment.show', $apt) }}">
                            <strong>{{ $translation->title ?? $apt->title }}</strong>
                        </a>
                        <div style="font-size: 12px; color: #666;">
                            {{ $translation->description ?? $apt->description }}
                        </div>
                    </td>
                    <td>{{ $apt->city }}</td>
                    <td>{{ $apt->rooms }}</td>
                    <td>{{ number_format($apt->price, 0, ',', ' ') }} $</td>
                    <td>
                        <a href="{{ route('apartment.edit', $apt) }}">{{ $currentLocale === 'en' ? 'Edit' : 'Редагувати' }}</a>
                        <form method="POST" action="{{ route('apartment.destroy', $apt) }}" style="display:inline; margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Видалити?')">{{ $currentLocale === 'en' ? 'Delete' : 'Видалити' }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Записів не знайдено.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
       {{ $apartments->links('pagination::simple-default') }}
    </div>
@endsection