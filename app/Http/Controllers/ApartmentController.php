<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Http\Requests\ApartmentRequest;
use Illuminate\Http\Request;
use App\Models\Feature;
use Illuminate\Support\Arr;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $currentLocale = in_array($request->query('lang'), ['uk', 'en']) 
            ? $request->query('lang') 
            : 'uk';

        $query = Apartment::with('translations')
            ->withCount('features'); // Додаткове завдання: кількість зручностей

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        $apartments = $query->orderByDesc('id')
            ->paginate(4)
            ->withQueryString();

        return view('apartment.index', compact('apartments', 'currentLocale'));
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