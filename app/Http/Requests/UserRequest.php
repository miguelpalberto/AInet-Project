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
            'name' => [
                'required',
                Rule::unique('users', 'name')->ignore($this->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->id),
            ],
            'user_type' =>          'required|in:C,E,A',
            'email_verified_at' =>  'optional',
            'password' =>  'optional',
            'blocked' =>  'optional',
            'photo_url' =>  'optional',

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
            'name.unique' =>    'O nome tem que ser único',
            'email.required' => 'O email é obrigatório',
            'email.email' =>    'O formato do email é inválido',
            'email.unique' =>   'O email tem que ser único',
            'user_type.required' => 'O tipo de utilizador é obrigatório',
            'user_type.in' => 'O tipo de utilizador tem de ser Funcionário(E) ou Administrador(A)',

            'password_inicial.required' => 'A password inicial é obrigatória',
        ];
    }
}
