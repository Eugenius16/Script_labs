@extends('layouts.app')

@section('title', 'Статистика відвідувань')

@section('content')
    <h1>Статистика відвідувань</h1>

   <p>
     <a href="{{ route('stats.pages', ['type' => 'page']) }}">За сторінками</a> | 
     <a href="{{ route('stats.pages', ['type' => 'ip']) }}">За IP-адресами</a> | 
     <a href="{{ route('stats.pages', ['type' => 'method']) }}">За HTTP-методами</a> | 
     <a href="{{ route('stats.search') }}"><strong>Пошук нерухомості</strong></a>
 </p>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 700px;">
        <thead>
            <tr style="background: #f2f2f2;">
                <th>{{ $type === 'page' ? 'Сторінка' : 'IP-адреса' }}</th>
                <th>Звернень</th>
                <th>Останній візит</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr>
                    <td>
                        <a href="{{ route('stats.detail', ['type' => $type, 'item' => $row->{$type}]) }}">
                            {{ $row->{$type} }}
                        </a>
                    </td>
                    <td>{{ $row->hits }}</td>
                    <td>{{ $row->last_visit }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">Даних ще немає.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection