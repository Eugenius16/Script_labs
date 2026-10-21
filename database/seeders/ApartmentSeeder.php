<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;

class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
        Apartment::insert([
            ['title' => 'Затишна студія в центрі', 'city' => 'Київ', 'rooms' => 1, 'price' => 45000, 'description' => 'З ремонтом та меблями'],
            ['title' => 'Простора 2-кімнатна біля парку', 'city' => 'Львів', 'rooms' => 2, 'price' => 65000, 'description' => 'Новобудова, автономне опалення'],
            ['title' => '3-кімнатна квартира з терасою', 'city' => 'Київ', 'rooms' => 3, 'price' => 95000, 'description' => 'Панорамний вигляд'],
            ['title' => '1-кімнатна квартира на березі моря', 'city' => 'Одеса', 'rooms' => 1, 'price' => 40000, 'description' => 'Ідеально під оренду'],
            ['title' => '2-кімнатна біля Опери', 'city' => 'Львів', 'rooms' => 2, 'price' => 75000, 'description' => 'Історичний центр міста'],
            ['title' => 'Видова квартира на Печерську', 'city' => 'Київ', 'rooms' => 2, 'price' => 110000, 'description' => 'Преміум-клас'],
            ['title' => 'Смарт-квартира для студента', 'city' => 'Київ', 'rooms' => 1, 'price' => 32000, 'description' => 'Біля КПІ'],
        ]);
    }
}