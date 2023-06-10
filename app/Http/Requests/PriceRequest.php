<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceRequest extends FormRequest
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
            'qty_discount' => 'int|min:2',
            'unit_price_catalog' => 'required|float',
            'unit_price_own' => 'required|float',
            'unit_price_catalog_discount'  => 'float',
            'unit_price_own_discount'  => 'float'
            
        ];
    }

    public function messages(): array//////
    {
        return [
            'qty_discount.min' => 'A quantidade minima de peças para ter desconto sao duas',
            'unit_price_catalog.required' => 'Preço de T-shirt com imagem do catálogo é obrigatório',
            'unit_price_own.required' => 'Preço de T-shirt com imagem propria é obrigatório',
            'unit_price_catalog_discount.float'  => 'Tem de ser um numero',
            'unit_price_own_discount.float'  => 'Tem de ser um numero'
        ];
    }
}
