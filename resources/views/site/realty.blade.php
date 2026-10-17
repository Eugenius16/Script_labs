@extends('layouts.app')

@section('title', 'Агентство нерухомості «Затишок»')

@section('content')
    <h1>{{ $companyName }}</h1>
    <p>Допомагаємо знайти дім вашої мрії швидко, безпечно та без зайвих турбот.</p>

    <hr>

    <h3>Наші послуги:</h3>
    <ul>
        @foreach($services as $service)
            <li>{{ $service }}</li>
        @endforeach
    </ul>

    <hr>

    <h2>Залишити заявку на підбір нерухомості</h2>
    <form method="POST" action="{{ route('realty.feedback') }}">
        @csrf

        <div style="margin-bottom: 10px;">
            <label for="name">Ваше ім'я:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" style="width: 300px;">
            @error('name')
                <p style="color: red; margin: 2px 0;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="email">Ваш Email:</label><br>
            <input type="text" id="email" name="email" value="{{ old('email') }}" style="width: 300px;">
            @error('email')
                <p style="color: red; margin: 2px 0;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
            <label for="message">Побажання (район, бюджет, кількість кімнат):</label><br>
            <textarea id="message" name="message" rows="4" style="width: 300px;">{{ old('message') }}</textarea>
            @error('message')
                <p style="color: red; margin: 2px 0;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-bottom: 10px;">
    <label for="budget">Планований бюджет ($):</label><br>
    <input type="number" id="budget" name="budget" value="{{ old('budget') }}" style="width: 300px;">
    @error('budget')
        <p style="color: red; margin: 2px 0;">{{ $message }}</p>
    @enderror
</div>
        <button type="submit">Відправити заявку</button>
    </form>
@endsection