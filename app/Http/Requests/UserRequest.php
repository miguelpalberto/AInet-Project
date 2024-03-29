<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;//
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->id),
            ],
            'user_type' =>          'required|in:C,E,A',
            'email_verified_at' =>  'nullable',
            'file_photo' =>  'sometimes|image|max:4096',

            'password_inicial' =>       'sometimes|required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' =>  'O nome é obrigatório',
            'name.string' =>  'O nome tem de ser uma string',
            'name.max' =>  'O nome tem de ter no máximo 255 caracteres',
            'name.unique' =>    'O nome tem que ser único',
            'email.required' => 'O email é obrigatório',
            'email.email' =>    'O formato do email é inválido',
            'email.unique' =>   'O email tem que ser único',
            'email.max' =>      'O email tem de ter no máximo 255 caracteres',
            'user_type.required' => 'O tipo de utilizador é obrigatório',
            'user_type.in' => 'O tipo de utilizador tem de ser Funcionário(E) ou Administrador(A)',
            'file_photo.image' => 'O ficheiro com a foto nao é uma imagem',
            'file_photo.size' => 'O tamanho do ficheiro com a foto tem que ser inferior a 4 Mb',

            'password_inicial.required' => 'A password inicial é obrigatória',
        ];
    }
}
