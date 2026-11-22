@extends('layouts.app')

@section('title', 'Користувачі')

@section('content')
    <h1>Користувачі системи</h1>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 750px;">
        <thead>
            <tr style="background: #f1f5f9;">
                <th>№</th>
                <th>Ім'я</th>
                <th>Email</th>
                <th>Зареєстровано</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $i => $user)
                <tr>
                    <td>{{ $users->firstItem() + $i }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at?->format('d.m.Y H:i') ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Користувачів немає.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $users->links('pagination::simple-default') }}
    </div>
@endsection