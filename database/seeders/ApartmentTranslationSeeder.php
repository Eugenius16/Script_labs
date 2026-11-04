<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\ApartmentTranslation;

class ApartmentTranslationSeeder extends Seeder
{
    public function run(): void
    {
        $apartments = Apartment::orderBy('id')->get();

        $translationsData = [
            1 => [
                'uk' => ['title' => 'Затишна студія в центрі', 'desc' => 'З ремонтом та меблями у серці міста.'],
                'en' => ['title' => 'Cozy Studio in City Center', 'desc' => 'Fully renovated and furnished in the downtown.'],
            ],
            2 => [
                'uk' => ['title' => 'Простора 2-кімнатна біля парку', 'desc' => 'Новобудова, автономне опалення, мальовничий краєвид.'],
                'en' => ['title' => 'Spacious 2-Room Near the Park', 'desc' => 'New building with autonomous heating and green view.'],
            ],
            3 => [
                'uk' => ['title' => '3-кімнатна квартира з терасою', 'desc' => 'Панорамний вигляд, сучасне планування, два санвузли.'],
                'en' => ['title' => '3-Room Apartment with Terrace', 'desc' => 'Panoramic view, modern layout, two bathrooms.'],
            ],
            4 => [
                'uk' => ['title' => '1-кімнатна квартира на березі моря', 'desc' => 'Перша лінія, закрита територія, ідеально під оренду.'],
                'en' => ['title' => '1-Room Apartment by the Sea', 'desc' => 'First line, private area, great for rental investment.'],
            ],
            5 => [
                'uk' => ['title' => '2-кімнатна біля Опери', 'desc' => 'Історичний центр міста, австрійський люкс, високі стелі.'],
                'en' => ['title' => '2-Room Flat Near the Opera House', 'desc' => 'Historic city center, classic architecture, high ceilings.'],
            ],
            6 => [
                'uk' => ['title' => 'Видова квартира на Печерську', 'desc' => 'Преміум-клас, підземний паркінг, консьєрж-сервіс.'],
                'en' => ['title' => 'Scenic Apartment in Pechersk', 'desc' => 'Premium class, underground parking, concierge service.'],
            ],
            7 => [
                'uk' => ['title' => 'Смарт-квартира для студента', 'desc' => 'Біля КПІ, низькі комунальні платежі, гарна транспортна розв\'язка.'],
                'en' => ['title' => 'Smart Apartment for Student', 'desc' => 'Near KPI campus, low utility costs, great transport links.'],
            ],
        ];

        foreach ($apartments as $index => $apartment) {
            $data = $translationsData[$apartment->id] ?? [
                'uk' => ['title' => $apartment->title, 'desc' => $apartment->description],
                'en' => ['title' => $apartment->title . ' (EN)', 'desc' => $apartment->description . ' (English version)'],
            ];

            ApartmentTranslation::updateOrCreate(
                ['apartment_id' => $apartment->id, 'locale' => 'uk'],
                ['title' => $data['uk']['title'], 'description' => $data['uk']['desc']]
            );

            ApartmentTranslation::updateOrCreate(
                ['apartment_id' => $apartment->id, 'locale' => 'en'],
                ['title' => $data['en']['title'], 'description' => $data['en']['desc']]
            );
        }
    }
}