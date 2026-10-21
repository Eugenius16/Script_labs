@extends('layouts.app')

@section('title', 'Довідник країн')

@section('content')
    <h1>Довідник країн</h1>

    <p>
        <a href="{{ route('country.create') }}">Додати країну</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; max-width: 700px;">
        <thead>
            <tr style="background: #f2f2f2;">
                <th>#</th>
                <th>Код</th>
                <th>Назва</th>
                <th>Населення</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($countries as $i => $country)
                <tr>
                    <td>{{ $countries->firstItem() + $i }}</td>
                    <td>{{ $country->code }}</td>
                    <td>
                        <a href="{{ route('country.show', $country) }}">{{ $country->name }}</a>
                    </td>
                    <td>{{ number_format($country->population, 0, ',', ' ') }}</td>
                    <td>
                        <a href="{{ route('country.edit', $country) }}">Редагувати</a>
                        <form method="POST" action="{{ route('country.destroy', $country) }}" style="display:inline; margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Видалити країну?')">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $countries->links() }}
    </div>
@endsection