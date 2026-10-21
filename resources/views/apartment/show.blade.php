@extends('layouts.app')

@section('title', $apartment->title)

@section('content')
    <h1>{{ $apartment->title }}</h1>
    <p><strong>Місто:</strong> {{ $apartment->city }}</p>
    <p><strong>Кількість кімнат:</strong> {{ $apartment->rooms }}</p>
    <p><strong>Ціна:</strong> {{ number_format($apartment->price, 0, ',', ' ') }} $</p>
    <p><strong>Опис:</strong> {{ $apartment->description ?? 'Немає опису' }}</p>

    <p>
        <a href="{{ route('apartment.edit', $apartment) }}">Редагувати</a> | 
        <a href="{{ route('apartment.index') }}">Повернутися до каталогу</a>
    </p>
@endsection