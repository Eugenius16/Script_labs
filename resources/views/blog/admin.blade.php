@extends('layouts.app')

@section('title', 'Адміністрування блогу')

@section('content')
    <h1>Адміністрування блогу</h1>

    <p>
        <a href="{{ route('blog.create') }}">+ Додати запис</a> | 
        <a href="{{ route('blog.index') }}">Перегляд блогу (картки)</a>
    </p>

    <!-- Форма пошуку та фільтрації (Case 3) -->
    <form method="GET" action="{{ route('blog.admin') }}" style="margin-bottom: 20px; padding: 15px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px;">
        <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
            <div>
                <label for="title">Заголовок:</label><br>
                <input type="text" id="title" name="title" value="{{ request('title') }}" placeholder="Пошук за заголовком">
            </div>

            <div>
                <label for="categoryName">Назва категорії:</label><br>
                <input type="text" id="categoryName" name="categoryName" value="{{ request('categoryName') }}" placeholder="Назва категорії">
            </div>

            <div>
                <label for="category_id">Категорія:</label><br>
                <select id="category_id" name="category_id">
                    <option value="">Усі категорії</option>
                    @foreach ($categories as $id => $name)
                        <option value="{{ $id }}" @selected(request('category_id') == $id)>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="filter_id">Мітка:</label><br>
                <select id="filter_id" name="filter_id">
                    <option value="">Усі мітки</option>
                    @foreach ($filters as $id => $name)
                        <option value="{{ $id }}" @selected(request('filter_id') == $id)>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="sort" value="{{ request('sort') }}">

            <div style="margin-top: 18px;">
                <button type="submit">Застосувати</button>
                <a href="{{ route('blog.admin') }}" style="margin-left: 8px;">Скинути</a>
            </div>
        </div>
    </form>

    <!-- Таблиця з сортуванням колонок (Case 2) -->
    @php
        $currentSort = request('sort');
        $sortLinks = [
            'title'        => $currentSort === 'title' ? '-title' : 'title',
            'categoryName' => $currentSort === 'categoryName' ? '-categoryName' : 'categoryName',
            'created'      => $currentSort === 'created' ? '-created' : 'created',
        ];
    @endphp

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 950px;">
        <thead>
            <tr style="background: #f1f5f9;">
                <th>№</th>
                <th>
                    <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $sortLinks['title']])) }}">
                        Заголовок
                        @if ($currentSort === 'title') ↑ @elseif ($currentSort === '-title') ↓ @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $sortLinks['categoryName']])) }}">
                        Категорія
                        @if ($currentSort === 'categoryName') ↑ @elseif ($currentSort === '-categoryName') ↓ @endif
                    </a>
                </th>
                <th>Мітки</th>
                <th>
                    <a href="{{ route('blog.admin', array_merge(request()->except('sort', 'page'), ['sort' => $sortLinks['created']])) }}">
                        Дата
                        @if ($currentSort === 'created') ↑ @elseif ($currentSort === '-created') ↓ @endif
                    </a>
                </th>
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
                    <td>
                        @forelse ($blog->filters as $filter)
                            <span style="background: #e0f2fe; color: #0369a1; padding: 2px 6px; border-radius: 3px; font-size: 12px;">
                                #{{ $filter->filter_name }}
                            </span>
                        @empty
                            —
                        @endforelse
                    </td>
                    <td>{{ $blog->dt_created->format('d.m.Y H:i') }}</td>
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
                    <td colspan="6" style="text-align: center;">Записів за вказаними фільтрами не знайдено.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $blogs->links() }}
    </div>
@endsection