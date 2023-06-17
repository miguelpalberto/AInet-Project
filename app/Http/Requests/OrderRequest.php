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
            'date' => 'required|date_format:Y-m-d',
            'total_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'notes' => 'nullable|string|max:255',
            'nif' => 'required|integer|digits:9',
            'address' => 'required|string|max:255',//TODO default address
            'payment_type' => 'nullable|in:VISA,MC,PAYPAL',
            'payment_ref' => [
                Rule::requiredIf(function () {
                    return $this->input('payment_type') !== null;
                }),
            ],
            'receipt_url' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [

            'customer_id.required' => 'ID do cliente é obrigatório',
            'customer_id.integer' => 'ID do cliente tem de ser um numero inteiro',
            'date.required' => 'A data é obrigatória',
            'date.integer' => 'A data tem de ser um numero inteiro',
            'date.date_format' => 'A data tem de estar no formato ano-mês-dia',
            'total_price.required' => 'O preço total é obrigatório',
            'total_price.regex' => 'O preço total tem de ser um numero',
            'notes.string' => 'As notas tem de ser uma string',
            'notes.max' => 'As notas podem ter no máximo 255 caracteres',
            'nif.required' => 'O NIF é obrigatório',
            'nif.integer' => 'O NIF tem de ser um numero inteiro',
            'nif.digits' => 'O NIF tem de ter 9 digitos',
            'address.required' => 'A morada é obrigatória',
            'address.string' => 'A morada tem de ser uma string',
            'address.max' => 'A morada pode ter no máximo 255 caracteres',
            'payment_type.in' => 'O tipo de pagamento tem de ser VISA, MC ou PAYPAL',
            'payment_ref.required' => 'A referencia de pagamento é obrigatória',
            'payment_ref.string' => 'A referencia de pagamento tem de ser uma string',
            'payment_ref.max' => 'A referencia de pagamento pode ter no máximo 255 caracteres',
            'receipt_url.integer' => 'O url do recibo tem de ser um numero inteiro',





        ];
    }
}
