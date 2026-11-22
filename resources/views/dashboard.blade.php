<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   <h3 class="text-lg font-bold text-gray-900 mb-2">Особистий кабінет рієлтора: {{ auth()->user()->name }}</h3>
<p class="text-gray-600 mb-4">Ваша робоча панель керування об'єктами нерухомості агентства «Затишок».</p>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <h4 class="font-semibold text-blue-800">Керування нерухомістю</h4>
        <p class="text-sm text-gray-600">Всього доступно в базі: <strong>{{ \App\Models\Apartment::count() }}</strong> об'єктів.</p>
        <a href="{{ route('apartment.create') }}" class="inline-block mt-2 text-sm text-blue-600 hover:underline font-bold">+ Додати новий об'єкт</a>
    </div>

    <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
        <h4 class="font-semibold text-green-800">Керування публікаціями</h4>
        <p class="text-sm text-gray-600">Всього опубліковано статей блогу: <strong>{{ \App\Models\Blog::count() }}</strong>.</p>
        <a href="{{ route('blog.admin') }}" class="inline-block mt-2 text-sm text-green-600 hover:underline font-bold">&rarr; Перейти до адміністрування блогу</a>
    </div>
</div>

<div class="mt-4 pt-4 border-t border-gray-200">
    <a href="{{ route('apartment.index') }}" class="text-indigo-600 hover:underline font-semibold">&larr; Перейти до публічного каталогу квартир</a>
</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
