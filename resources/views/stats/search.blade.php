@extends('layouts.app')

@section('title', 'Популярність пошуку нерухомості')

@section('content')
    <h1>Популярність пошукових запитів міст</h1>
    <p>Аналіз того, які міста користувачі найчастіше шукають у каталозі нерухомості.</p>

    <p>
        <a href="{{ route('stats.pages') }}">Повернутися до загальної статистики</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 600px;">
        <thead>
            <tr style="background: #e9ecef;">
                <th>Шукане місто</th>
                <th>Кількість пошуків</th>
                <th>Останній запит</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr>
                    <td><strong>{{ $row->city }}</strong></td>
                    <td>{{ $row->searches }}</td>
                    <td>{{ $row->last_search }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">Пошукових запитів ще не зафіксовано. Перейдіть до каталогу та виконайте пошук за містом!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection