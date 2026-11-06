<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Http\Requests\ApartmentRequest;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        $currentLocale = in_array($request->query('lang'), ['uk', 'en']) 
            ? $request->query('lang') 
            : 'uk';

        $query = Apartment::with('translations');

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
        return view('apartment.create');
    }

    public function store(ApartmentRequest $request)
    {
        Apartment::create($request->validated());

        return redirect()->route('apartment.index')->with('success', 'Оголошення успішно додано!');
    }

    public function show(Apartment $apartment)
    {
        return view('apartment.show', compact('apartment'));
    }

    public function edit(Apartment $apartment)
    {
        return view('apartment.edit', compact('apartment'));
    }

    public function update(ApartmentRequest $request, Apartment $apartment)
    {
        $apartment->update($request->validated());

        return redirect()->route('apartment.index')->with('success', 'Дані оновлено!');
    }

    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('apartment.index')->with('success', 'Оголошення видалено!');
    }
}