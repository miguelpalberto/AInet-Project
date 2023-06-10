<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;//
    }
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|string|max:50',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.string' => 'O email tem que ser uma string',
            'email.max' => 'O email pode ter no máximo 50 caracteres',
        ];
    }
}
