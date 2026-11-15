<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feature;
use App\Models\Apartment;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            'Балкон / Лоджія',
            'Підземний паркінг',
            'Кондиціонер',
            'Автономне опалення',
            'Охорона території',
            'Панорамні вікна',
        ];

        foreach ($features as $name) {
            Feature::firstOrCreate(['name' => $name]);
        }

        // Прив'яжемо перші дві зручності до першої квартири для наочності
        $apartment = Apartment::first();
        if ($apartment) {
            $featureIds = Feature::take(3)->pluck('id')->all();
            $apartment->features()->sync($featureIds);
        }
    }
}