<?php

namespace App\Queries;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Builder;

class ApartmentFilter
{
    private const SORTABLE = [
        'title'         => 'title',
        'city'          => 'city',
        'price'         => 'price',
        'featuresCount' => 'features_count', 
    ];

    public function apply(array $input): Builder
    {
        $query = Apartment::query()
            ->with(['features', 'translations']) 
            ->withCount('features');             


        $query->when(
            $input['title'] ?? null,
            fn (Builder $q, $value) => $q->where('title', 'like', "%{$value}%")
        );


        $query->when(
            $input['city'] ?? null,
            fn (Builder $q, $value) => $q->where('city', 'like', "%{$value}%")
        );


        $query->when(
            $input['feature_id'] ?? null,
            fn (Builder $q, $value) => $q->whereHas(
                'features',
                fn (Builder $related) => $related->whereKey($value)
            )
        );

        return $this->sort($query, $input['sort'] ?? null);
    }

    private function sort(Builder $query, ?string $sort): Builder
    {
        $desc = str_starts_with($sort ?? '', '-');
        $field = $desc ? substr($sort, 1) : $sort;

        if (!isset(self::SORTABLE[$field])) {
            return $query->orderByDesc('id');
        }

        return $query
            ->orderBy(
                self::SORTABLE[$field],
                $desc ? 'desc' : 'asc'
            )
            ->orderByDesc('id');
    }
}