@extends('layouts.app')

@section('title', 'Адміністрування блогу')

@section('content')
    <h1>Адміністрування блогу</h1>

    <p>
        <a href="{{ route('blog.create') }}">+ Додати запис</a> | 
        <a href="{{ route('blog.index') }}">Перегляд блогу (картки)</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 850px;">
        <thead>
            <tr style="background: #f2f2f2;">
                <th>№</th>
                <th>Заголовок</th>
                <th>Категорія</th>
                <th>Дата</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($blogs as $i => $blog)
                <tr>
                    <td>{{ $blogs->firstItem() + $i }}</td>
                    <td>
                        <a href="{{ route('blog.show', $blog) }}"><strong>{{ $blog->title }}</strong></a>
                    </td>
                    <td>{{ $blog->category?->category_name ?? '—' }}</td>
                    <td>{{ $blog->dt_created->format('d.m.Y') }}</td>
                    <td>
                        <a href="{{ route('blog.edit', $blog) }}">Редагувати</a>
                        <form method="POST" action="{{ route('blog.destroy', $blog) }}" style="display:inline; margin-left: 8px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Видалити цей запис?')">Видалити</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Записів немає.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $blogs->links() }}
    </div>
@endsection