<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'   => ['required', 'string', 'min:5', 'max:255'],
            'excerpt' => ['required', 'string', 'min:20', 'max:500'],
            'body'    => ['required', 'string', 'min:30'],
            'image'   => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'   => 'Укажите заголовок новости',
            'title.min'        => 'Заголовок должен быть не короче :min символов',
            'excerpt.required' => 'Добавьте краткое описание',
            'excerpt.min'      => 'Описание должно быть не короче :min символов',
            'body.required'    => 'Текст новости обязателен',
            'body.min'         => 'Текст должен быть не короче :min символов',
        ];
    }
}
