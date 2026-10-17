@extends('layouts.app')

@section('title', 'Заявку прийнято')

@section('content')
    <h1 style="color: green;">Дякуємо! Вашу заявку прийнято.</h1>
    <p>Наш рієлтор зв'яжеться з вами найближчим часом за вказаними контактами:</p>

    <ul>
    <li><strong>Клієнт:</strong> {{ $name }}</li>
    <li><strong>Email:</strong> {{ $email }}</li>
    <li><strong>Бюджет:</strong> {{ $budget }} $</li>
    <li><strong>Ваші побажання:</strong> {{ $message }}</li>
</ul>

    <p>
        <a href="{{ route('realty.page') }}">Повернутися до сторінки нерухомості</a>
    </p>
@endsection