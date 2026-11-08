@extends('layouts.app')

@section('title', 'Керування мітками')

@section('content')
    <h1>Мітки запису: {{ $blog->title }}</h1>

    <form method="POST" action="{{ route('blog.tags.store', $blog) }}">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="duallist"><strong>Оберіть мітки запису (затисніть Ctrl для вибору кількох):</strong></label><br>
            <select id="duallist" name="filters[]" multiple size="7" style="width: 350px; padding: 8px;">
                @foreach ($filters as $id => $name)
                    <option value="{{ $id }}" @selected(in_array($id, old('filters', $selected)))>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Зберегти мітки</button>
        <a href="{{ route('blog.show', $blog) }}" style="margin-left: 10px;">Назад</a>
    </form>
@endsection