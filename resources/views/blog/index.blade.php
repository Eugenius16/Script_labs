@extends('layouts.app')

@section('title', 'Блог')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Блог</h1>
        <div>
            <a href="{{ route('blog.create') }}" style="margin-right: 15px;">+ Додати запис</a>
            <a href="{{ route('blog.admin') }}">Адміністрування</a>
        </div>
    </div>

    <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin: 20px 0;">
        @forelse ($blogs as $blog)
            @include('blog._item', ['blog' => $blog])
        @empty
            <p>Записів поки немає.</p>
        @endforelse
    </div>

    <div style="margin-top: 15px;">
        {{ $blogs->links() }}
    </div>
@endsection