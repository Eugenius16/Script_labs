<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    protected $fillable = [
        'title',
        'city',
        'rooms',
        'price',
        'description',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(ApartmentTranslation::class);
    }

    public function translation(string $locale = 'uk')
    {
        return $this->translations->firstWhere('locale', $locale)
            ?? $this->translations->firstWhere('locale', 'uk');
    }
}