@extends('layouts.app')

@section('title', 'Детальна статистика')

@section('content')
    <h1>Детальна статистика</h1>

    <p>
        Фільтр: <strong>{{ $type }}</strong> = <strong>{{ $item }}</strong> | 
        <a href="{{ route('stats.pages') }}">Повернутися до зведеної статистики</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 800px;">
        <thead>
            <tr style="background: #f2f2f2;">
                <th>Сторінка</th>
                <th>IP</th>
                <th>Статус</th>
                <th>Дата і час</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    <td>{{ $row->page }}</td>
                    <td>{{ $row->ip }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->visited_at->format('d.m.Y H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $rows->links() }}
    </div>
@endsection