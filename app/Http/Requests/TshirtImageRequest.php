<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TshirtImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //true!
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'nullable|integer|exists:customers,id',
            'category_id' => 'nullable|integer|exists:categories,id',
            'name' =>        'required|string|max:30',
            'description' => 'nullable|string|max:100',
            'image_url' =>   'nullable',//apagar
            //'image_url' =>   'required|string|max:255',//TODO
            'extra_info' =>   'nullable',//TODO
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array//////
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'customer_id.exists' => 'O customer não existe na base de dados',
            'customer_id.integer' => 'O ID do customer tem que ser um número inteiro',
            'category_id.exists' => 'A categoria não existe na base de dados',
            'category_id.integer' => 'O ID da categoria tem que ser um número inteiro',
            'description.string' => 'A descrição tem que ser uma string',
            'description.max' => 'A descrição pode ter no máximo 100 caracteres',
            'image_url.required' => 'A imagem é obrigatória',
            'image_url.string' => 'O url da imagem tem que ser uma string',
            'image_url.max' => 'O url da imagem pode ter no máximo 255 caracteres',
            'extra_info' => '',//TODO
        ];
    }
}

