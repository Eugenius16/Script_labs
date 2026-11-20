<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Http\Requests\ApartmentRequest;
use Illuminate\Http\Request;
use App\Models\Feature;
use Illuminate\Support\Arr;
use App\Queries\ApartmentFilter;

class ApartmentController extends Controller
{
    public function index(Request $request, ApartmentFilter $filter)
    {
        $currentLocale = in_array($request->query('lang'), ['uk', 'en']) 
            ? $request->query('lang') 
            : 'uk';

        $input = $request->validate([
            'title'      => ['nullable', 'string', 'max:255'],
            'city'       => ['nullable', 'string', 'max:100'],
            'feature_id' => ['nullable', 'integer', 'exists:features,id'],
            'sort'       => ['nullable', 'string', 'max:30'],
        ]);

        $apartments = $filter->apply($input)
            ->paginate(4)
            ->withQueryString();

        $features = Feature::orderBy('name')->pluck('name', 'id');

        return view('apartment.index', compact('apartments', 'currentLocale', 'features'));
    }

    public function create()
    {
        $features = Feature::pluck('name', 'id');
        return view('apartment.create', compact('features'));
    }

    public function store(ApartmentRequest $request)
    {
        $data = $request->validated();

        $apartment = Apartment::create(Arr::except($data, ['features']));
        $apartment->features()->sync($data['features'] ?? []);

        return redirect()->route('apartment.index')->with('success', 'Оголошення успішно додано!');
    }

    public function show(Apartment $apartment)
    {
        $apartment->load('features');
        return view('apartment.show', compact('apartment'));
    }

    public function edit(Apartment $apartment)
    {
        $apartment->load('features');
        $features = Feature::pluck('name', 'id');
        $selectedFeatures = $apartment->features->pluck('id')->all();

        return view('apartment.edit', compact('apartment', 'features', 'selectedFeatures'));
    }

    public function update(ApartmentRequest $request, Apartment $apartment)
    {
        $data = $request->validated();

        $apartment->update(Arr::except($data, ['features']));
        $apartment->features()->sync($data['features'] ?? []);

        return redirect()->route('apartment.index')->with('success', 'Дані оновлено!');
    }

    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('apartment.index')->with('success', 'Оголошення видалено!');
    }
}