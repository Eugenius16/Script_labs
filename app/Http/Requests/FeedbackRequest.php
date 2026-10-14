<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email'],
            'message' => ['required', 'string', 'min:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Вкажіть ваше ім\'я.',
            'email.required'   => 'Вкажіть електронну пошту.',
            'email.email'      => 'Введіть коректний email.',
            'message.required' => 'Напишіть ваше повідомлення або побажання щодо нерухомості.',
            'message.min'      => 'Повідомлення має містити хоча б 5 символів.',
        ];
    }
}