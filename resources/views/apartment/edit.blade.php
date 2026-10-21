@extends('layouts.app')

@section('title', 'Редагувати квартиру')

@section('content')
    <h1>Редагувати оголошення</h1>
    <form method="POST" action="{{ route('apartment.update', $apartment) }}">
        @csrf
        @method('PUT')
        @include('apartment._form')
        <button type="submit">Зберегти зміни</button>
    </form>
@endsection