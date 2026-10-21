<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'city'        => ['required', 'string', 'max:100'],
            'rooms'       => ['required', 'integer', 'min:1', 'max:10'],
            'price'       => ['required', 'numeric', 'min:1000'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Вкажіть назву оголошення.',
            'city.required'  => 'Вкажіть місто.',
            'rooms.required' => 'Вкажіть кількість кімнат.',
            'rooms.integer'  => 'Кількість кімнат має бути цілим числом.',
            'price.required' => 'Вкажіть ціну.',
            'price.numeric'  => 'Ціна має бути числом.',
            'price.min'      => 'Ціна має бути не менше 1000 $.',
        ];
    }
}
