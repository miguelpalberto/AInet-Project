<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
            'status' => 'nullable|in:pending,paid,closed,canceled',
            'customer_id' => 'required|integer',
            'date' => 'required|integer:betwenn:1,31',
            'total_price' => 'required|float',
            'notes' => 'required|string|max:30',
            'nif' => 'required|integer|max:9',
            'address' => 'required|string|max:255',
            'payment_type' => 'nullable|in:VISA,MC,PAYPAL',
            'payment_ref' => [
                Rule::requiredIf(function () {
                    return $this->input('payment_type') !== null;
                }),
            ],
            'receipt_url' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            
            'status' => '',
            'customer_id' => 'Tem de inserir',
            'date' => 'Tem de inserir',
            'total_price' => 'TENS DE METER O PREÇO',
            'notes' => 'alterar',
            'nif' => 'NIF tem de ter no mínimo 9 números',
            'address' => 'Obrigatório',
            'payment_type' => 'Inserir o tipo de Pagamento',
            'payment_ref' => 'Tem de ser 9 caracteres',
            'receipt_url' => 'alterar',

        ];
    }
}
