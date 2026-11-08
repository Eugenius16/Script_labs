@extends('layouts.app')

@section('title', $blog->title)

@section('content')
    <article style="max-width: 750px;">
        <h1>{{ $blog->title }}</h1>
        <p style="color: #666; font-size: 14px;">
            Категорія: <strong>{{ $blog->category?->category_name ?? 'Без категорії' }}</strong> | 
            Автор: <strong>{{ $blog->author?->name ?? 'Редакція' }}</strong> | 
            Опубліковано: {{ $blog->dt_created->format('d.m.Y H:i') }}
        </p>

        <!-- Блок міток (Case 0) -->
        <div style="margin: 12px 0;">
            <strong>Мітки:</strong>
            @forelse ($blog->filters as $filter)
                <span style="background: #e0f2fe; color: #0369a1; padding: 3px 8px; border-radius: 4px; font-size: 13px; margin-right: 5px;">
                    #{{ $filter->filter_name }}
                </span>
            @empty
                <span style="color: #888;">Міток немає.</span>
            @endforelse
        </div>

        <hr>
        <p style="font-size: 16px; line-height: 1.6;">{{ $blog->text ?? $blog->description }}</p>
    </article>

    <p style="margin-top: 25px;">
        <a href="{{ route('blog.edit', $blog) }}">Редагувати</a> | 
        <a href="{{ route('blog.tags', $blog) }}">Керування мітками (DualListBox)</a> | 
        <a href="{{ route('blog.index') }}">Повернутися до блогу</a> | 
        <a href="{{ route('blog.admin') }}">До адміністрування</a>
    </p>
@endsection