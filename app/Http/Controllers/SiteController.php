<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EntryRequest;
use App\Http\Requests\FeedbackRequest;
use App\Enums\RealtyServiceEnum;

class SiteController extends Controller
{
    public function say(string $message = 'Привіт')
    {
        return view('site.say', ['message' => $message]);
    }

    public function entry()
    {
        return view('site.entry');
    }

    public function entryStore(EntryRequest $request)
    {
        return view('site.entry-confirm', $request->validated());
    }

    // МЕТОДИ ДЛЯ ІНДИВІДУАЛЬНОГО ЗАВДАННЯ:
   public function realty()
{
    $companyName = 'Агентство нерухомості "Затишок"';
    $services = RealtyServiceEnum::values();

    return view('site.realty', compact('companyName', 'services'));
}

    public function feedbackStore(FeedbackRequest $request)
    {
        return view('site.realty-confirm', $request->validated());
    }
}