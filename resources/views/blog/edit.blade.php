@extends('layouts.app')

@section('title', 'Редагувати запис')

@section('content')
    <h1>Редагування запису</h1>

    <form method="POST" action="{{ route('blog.update', $blog) }}">
        @method('PUT')
        @include('blog._form')
        <button type="submit">Зберегти зміни</button>
        <a href="{{ route('blog.admin') }}" style="margin-left: 10px;">Скасувати</a>
    </form>
@endsection