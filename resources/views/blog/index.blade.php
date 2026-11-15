@extends('layouts.app')

@section('title', 'Блог')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Блог</h1>
        <div>
            <a href="{{ route('blog.create') }}" style="margin-right: 15px;">+ Додати запис</a>
            <a href="{{ route('blog.admin') }}">Адміністрування</a>
        </div>
    </div>

    <!-- Меню фільтрації за мітками (Case 3) -->
    <nav style="margin: 15px 0; padding: 10px; background: #f1f5f9; border-radius: 6px;">
        <strong>Фільтр за мітками:</strong>
        <a href="{{ route('blog.index') }}" style="margin: 0 8px; {{ !$filterId ? 'font-weight: bold; text-decoration: underline;' : '' }}">Усі записи</a>
        @foreach ($filters as $id => $name)
            <a href="{{ route('blog.index', ['filter' => $id]) }}" style="margin: 0 8px; {{ $filterId == $id ? 'font-weight: bold; text-decoration: underline;' : '' }}">
                #{{ $name }}
            </a>
        @endforeach
    </nav>

    <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin: 20px 0;">
        @forelse ($blogs as $blog)
            @include('blog._item', ['blog' => $blog])
        @empty
            <p>Записів за цією міткою не знайдено.</p>
        @endforelse
    </div>

    <div style="margin-top: 15px;">
        {{ $blogs->links() }}
    </div>
@endsection