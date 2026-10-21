@extends('layouts.app')

@section('title', 'Додати квартиру')

@section('content')
    <h1>Додати квартиру в каталог</h1>
    <form method="POST" action="{{ route('apartment.store') }}">
        @csrf
        @include('apartment._form')
        <button type="submit">Опублікувати</button>
    </form>
@endsection