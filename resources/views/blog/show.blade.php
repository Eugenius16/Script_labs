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
        <hr>
        <p style="font-size: 16px; line-height: 1.6;">{{ $blog->text ?? $blog->description }}</p>
    </article>

    <p style="margin-top: 25px;">
        <a href="{{ route('blog.edit', $blog) }}">Редагувати</a> | 
        <a href="{{ route('blog.index') }}">Повернутися до блогу</a> | 
        <a href="{{ route('blog.admin') }}">До адміністрування</a>
    </p>
@endsection