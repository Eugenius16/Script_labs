@extends('layouts.app')

@section('title', $currentLocale === 'en' ? 'Property Catalog' : 'Каталог квартир')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h1>{{ $currentLocale === 'en' ? 'Real Estate Catalog' : 'Каталог нерухомості' }}</h1>

        <div style="font-size: 15px;">
            <strong>Language:</strong>
            <a href="{{ request()->fullUrlWithQuery(['lang' => 'uk']) }}" style="{{ $currentLocale === 'uk' ? 'font-weight: bold; text-decoration: underline;' : '' }}">🇺🇦 UK</a> | 
            <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}" style="{{ $currentLocale === 'en' ? 'font-weight: bold; text-decoration: underline;' : '' }}">🇬🇧 EN</a>
        </div>
    </div>

    <p>
        <a href="{{ route('apartment.create') }}">+ {{ $currentLocale === 'en' ? 'Add new property' : 'Додати нову квартиру' }}</a>
    </p>

    <!-- Форма розширеного пошуку та фільтрації (Індивідуальне завдання 7) -->
    <form method="GET" action="{{ route('apartment.index') }}" style="margin-bottom: 20px; padding: 15px; background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 6px;">
        <input type="hidden" name="lang" value="{{ $currentLocale }}">
        <input type="hidden" name="sort" value="{{ request('sort') }}">

        <div style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
            <div>
                <label for="title"><strong>Назва:</strong></label><br>
                <input type="text" id="title" name="title" value="{{ request('title') }}" placeholder="Пошук за назвою">
            </div>

            <div>
                <label for="city"><strong>Місто:</strong></label><br>
                <input type="text" id="city" name="city" value="{{ request('city') }}" placeholder="Київ, Львів...">
            </div>

            <div>
                <label for="feature_id"><strong>Наявність зручності:</strong></label><br>
                <select id="feature_id" name="feature_id">
                    <option value="">Усі зручності</option>
                    @foreach ($features as $id => $name)
                        <option value="{{ $id }}" @selected(request('feature_id') == $id)>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-top: 18px;">
                <button type="submit">Шукати</button>
                <a href="{{ route('apartment.index', ['lang' => $currentLocale]) }}" style="margin-left: 8px;">Скинути</a>
            </div>
        </div>
    </form>

    <!-- Сортування колонок -->
    @php
        $currentSort = request('sort');
        $sortLinks = [
            'title'         => $currentSort === 'title' ? '-title' : 'title',
            'city'          => $currentSort === 'city' ? '-city' : 'city',
            'price'         => $currentSort === 'price' ? '-price' : 'price',
            'featuresCount' => $currentSort === 'featuresCount' ? '-featuresCount' : 'featuresCount',
        ];
    @endphp

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 950px; margin-bottom: 20px;">
        <thead>
            <tr style="background: #e2e8f0;">
                <th>#</th>
                <th>
                    <a href="{{ route('apartment.index', array_merge(request()->except('sort', 'page'), ['sort' => $sortLinks['title']])) }}">
                        {{ $currentLocale === 'en' ? 'Title' : 'Назва' }}
                        @if ($currentSort === 'title') ↑ @elseif ($currentSort === '-title') ↓ @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('apartment.index', array_merge(request()->except('sort', 'page'), ['sort' => $sortLinks['city']])) }}">
                        {{ $currentLocale === 'en' ? 'City' : 'Місто' }}
                        @if ($currentSort === 'city') ↑ @elseif ($currentSort === '-city') ↓ @endif
                    </a>
                </th>
                <th>{{ $currentLocale === 'en' ? 'Rooms' : 'Кімнат' }}</th>
                <th>
                    <a href="{{ route('apartment.index', array_merge(request()->except('sort', 'page'), ['sort' => $sortLinks['price']])) }}">
                        {{ $currentLocale === 'en' ? 'Price ($)' : 'Ціна ($)' }}
                        @if ($currentSort === 'price') ↑ @elseif ($currentSort === '-price') ↓ @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('apartment.index', array_merge(request()->except('sort', 'page'), ['sort' => $sortLinks['featuresCount']])) }}">
                        Зручностей
                        @if ($currentSort === 'featuresCount') ↑ @elseif ($currentSort === '-featuresCount') ↓ @endif
                    </a>
                </th>
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
                        <div style="font-size: 12px; color: #64748b;">
                            {{ $translation->description ?? $apt->description }}
                        </div>
                    </td>
                    <td>{{ $apt->city }}</td>
                    <td>{{ $apt->rooms }}</td>
                    <td><strong>{{ number_format($apt->price, 0, ',', ' ') }} $</strong></td>
                    <td style="text-align: center; color: #0284c7; font-weight: bold;">
                        {{ $apt->features_count }}
                    </td>
                    <td>
                        <a href="{{ route('apartment.edit', $apt) }}">{{ $currentLocale === 'en' ? 'Edit' : 'Редагувати' }}</a>
                        <form method="POST" action="{{ route('apartment.destroy', $apt) }}" style="display:inline; margin-left: 8px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Видалити?')">{{ $currentLocale === 'en' ? 'Delete' : 'Видалити' }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Квартир за вказаними фільтрами не знайдено.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-bottom: 25px;">
        {{ $apartments->links('pagination::simple-default') }}
    </div>
@endsection