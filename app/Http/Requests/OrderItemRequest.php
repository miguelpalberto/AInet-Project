<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tshirt_image_id' => 'required|integer',
            'color_code' => 'required|string|size:6',
            'size' => 'required|string|max:2',
            'qty' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0.01',
            'sub_total' => 'required|numeric|min:0.01',
        ];
    }

    public function messages(): array
    {
        return [
            'tshirt_image_id.required' => 'A imagem da camisola é obrigatória',
            'tshirt_image_id.integer' => 'A imagem da camisola tem de ser um inteiro',
            'color_code.required' => 'A cor é obrigatória',
            'color_code.string' => 'A cor tem de ser uma string',
            'color_code.size' => 'A cor tem de ter 6 caracteres',
            'size.required' => 'O tamanho é obrigatório',
            'size.string' => 'O tamanho tem de ser uma string',
            'size.max' => 'O tamanho tem de ter 2 caracteres',
            'qty.required' => 'A quantidade é obrigatória',
            'qty.integer' => 'A quantidade tem de ser um inteiro',
            'qty.min' => 'A quantidade tem de ser no mínimo 1',
            'unit_price.required' => 'O preço unitário é obrigatório',
            'unit_price.numeric' => 'O preço unitário tem de ser um número',
            'unit_price.min' => 'O preço unitário tem de ser no mínimo 0.01',
            'sub_total.required' => 'O subtotal é obrigatório',
            'sub_total.numeric' => 'O subtotal tem de ser um número',
            'sub_total.min' => 'O subtotal tem de ser no mínimo 0.01',

        ];
    }
}
