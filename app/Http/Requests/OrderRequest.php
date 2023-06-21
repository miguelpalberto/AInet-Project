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
            'nif' => 'nullable|integer|digits:9',//TODO default nif
            'address' => 'required|string|max:255',//TODO default address
            'payment_type' => 'required|in:VISA,MC,PAYPAL',
            'payment_ref' => 'required|integer|digits_between:3,20',
            'receipt_url' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [

            'status.in' => 'O status tem de ser pending, paid, closed ou canceled',
            'customer_id.required' => 'ID do cliente é obrigatório',
            'customer_id.integer' => 'ID do cliente tem de ser um numero inteiro',
            'date.required' => 'A data é obrigatória',
            'date.integer' => 'A data tem de ser um numero inteiro',
            'date.date_format' => 'A data tem de estar no formato ano-mês-dia',
            'total_price.required' => 'O preço total é obrigatório',
            'total_price.regex' => 'O preço total tem de ser um numero',
            'notes.string' => 'As notas tem de ser uma string',
            'notes.max' => 'As notas podem ter no máximo 255 caracteres',
            //'nif.required' => 'O NIF é obrigatório',
            'nif.integer' => 'O NIF tem de ser um numero inteiro',
            'nif.digits' => 'O NIF tem de ter 9 digitos',
            'address.required' => 'A morada é obrigatória',
            'address.string' => 'A morada tem de ser uma string',
            'address.max' => 'A morada pode ter no máximo 255 caracteres',
            'payment_type.required' => 'O tipo de pagamento é obrigatório',
            'payment_type.in' => 'O tipo de pagamento tem de ser VISA, MC ou PAYPAL',
            'payment_ref.required' => 'A referencia de pagamento é obrigatória',
            'payment_ref.integer' => 'A referencia de pagamento tem de ser um numero inteiro',
            'payment_ref.digits_between' => 'A referencia de pagamento tem de ter entre 3 e 20 digitos',
            'receipt_url.string' => 'O url do recibo tem de ser uma string',
            'receipt_url.max' => 'O url do recibo pode ter no máximo 255 caracteres',





        ];
    }
}
