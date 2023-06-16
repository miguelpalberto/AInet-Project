<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'code' => [
            //     'required',
            //     'string',
            //     'size:6',
            //     Rule::unique('colors', 'code')->ignore($this->code),
            // ],
            'code' => 'required|string|size:6|unique:colors',
            'name' => 'required|string|max:15',
        ];
    }

    public function messages(): array//////
    {
        return [
            'name.max' => 'A quantidade maxima de caracteres do nome é de 15 caracteres',
            'code.required' =>  'O código é obrigatório',
            'code.string' =>  'O código tem de ser uma string',
            'code.size' =>  'O código tem de ter 6 caracteres',
            'code.unique' =>  'O código tem de ser único (já existe esse código de cor)',

        ];
    }

}
