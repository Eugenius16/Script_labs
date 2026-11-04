@extends('layouts.app')

@section('title', 'Створити запис')

@section('content')
    <h1>Створити запис блогу</h1>

    <form method="POST" action="{{ route('blog.store') }}">
        @include('blog._form')
        <button type="submit">Зберегти запис</button>
        <a href="{{ route('blog.index') }}" style="margin-left: 10px;">Скасувати</a>
    </form>
@endsection