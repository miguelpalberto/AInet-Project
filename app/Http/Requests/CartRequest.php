<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'color' => 'required|exists:colors,code',
            'size' => 'required|in:XS,S,M,L,XL',
            'qty' => 'required|integer|min:1',
            //'unit_price' => 'required|numeric|min:0.01',
            //'sub_total' => 'required|numeric|min:0.01',
        ];
    }

    public function messages(): array
    {
        return [
            'color_code.required' => 'A cor é obrigatória',
            'color_code.exists' => 'A cor tem de existir na tabela colors',
            'size.required' => 'O tamanho é obrigatório',
            'size.in' => 'O tamanho tem de ser XS, S, M, L ou XL',
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
