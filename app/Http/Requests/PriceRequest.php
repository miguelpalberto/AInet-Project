<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PriceRequest extends FormRequest
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
            'unit_price_catalog' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'unit_price_own' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'unit_price_catalog_discount' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'unit_price_own_discount' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'qty_discount' => 'nullable|integer|min:2',
        ];
    }

    public function messages(): array//////
    {
        return [
            'unit_price_catalog.required' => 'Preço de T-shirt com imagem do catálogo é obrigatório',
            'unit_price_own.required' => 'Preço de T-shirt com imagem propria é obrigatório',
            'unit_price_catalog.regex' => 'O preço de T-shirt com imagem do catálogo tem de ser um numero',
            'unit_price_own.regex' => 'O preço de T-shirt com imagem propria tem de ser um numero',
            'unit_price_catalog_discount.regex'  => 'Tem de ser um numero',
            'unit_price_own_discount.regex'  => 'Tem de ser um numero',
            'qty_discount.integer' => 'Tem de ser um numero inteiro',
            'qty_discount.min' => 'A quantidade minima de peças para ter desconto sao duas',

        ];
    }
}
