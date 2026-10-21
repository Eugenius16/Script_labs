@extends('layouts.app')

@section('title', $country->name)

@section('content')
    <h1>{{ $country->name }}</h1>

    <p><strong>Код:</strong> {{ $country->code }}</p>
    <p><strong>Населення:</strong> {{ number_format($country->population, 0, ',', ' ') }}</p>

    <p>
        <a href="{{ route('country.edit', $country) }}">Редагувати</a> | 
        <a href="{{ route('country.index') }}">Повернутися до списку</a>
    </p>
@endsection