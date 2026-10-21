@extends('layouts.app')

@section('title', 'Каталог квартир')

@section('content')
    <h1>Каталог нерухомості</h1>

    <p>
        <a href="{{ route('apartment.create') }}">+ Додати нову квартиру</a>
    </p>

    <!-- Форма фільтрації за містом (Додаткове завдання) -->
    <form method="GET" action="{{ route('apartment.index') }}" style="margin-bottom: 20px; padding: 10px; background: #f0f0f0; display: inline-block;">
        <label for="filter_city"><strong>Фільтр за містом:</strong></label>
        <input type="text" id="filter_city" name="city" value="{{ request('city') }}" placeholder="Наприклад: Київ, Львів">
        <button type="submit">Шукати</button>
        @if(request('city'))
            <a href="{{ route('apartment.index') }}" style="margin-left: 10px;">Скинути фільтр</a>
        @endif
    </form>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 800px;">
        <thead>
            <tr style="background: #e9ecef;">
                <th>#</th>
                <th>Назва</th>
                <th>Місто</th>
                <th>Кімнат</th>
                <th>Ціна ($)</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($apartments as $apt)
                <tr>
                    <td>{{ $apt->id }}</td>
                    <td><a href="{{ route('apartment.show', $apt) }}"><strong>{{ $apt->title }}</strong></a></td>
                    <td>{{ $apt->city }}</td>
                    <td>{{ $apt->rooms }}</td>
                    <td>{{ number_format($apt->price, 0, ',', ' ') }} $</td>
                    <td>
                        <a href="{{ route('apartment.edit', $apt) }}">Редагувати</a>
                        <form method="POST" action="{{ route('apartment.destroy', $apt) }}" style="display:inline; margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Видалити квартиру?')">Видалити</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Квартир за вказаними критеріями не знайдено.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $apartments->links() }}
    </div>
@endsection