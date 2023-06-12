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
            'status' => 'required|in:pending,paid,closed,canceled',
            'customer_id' => 'required|integer',
            'date' => 'required|integer:betwenn:1,31',
            'total_price' => 'required|float',
            'notes' => 'required|string|max:30',
            'nif' => 'required|integer|max:9',
            'address' => 'required|string|max:50',
            'payment_type' => 'required|in:VISA,MC,PAYPAL',
            'payment_ref' => 'required|integer',
            'receipt_url' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            
            'status' => 'alterar',
            'customer_id' => 'alterar',
            'date' => 'alterar',
            'total_price' => 'alterar',
            'notes' => 'alterar',
            'nif' => 'alterar',
            'address' => 'alterar',
            'payment_type' => 'alterar',
            'payment_ref' => 'alterar',
            'receipt_url' => 'alterar',

        ];
    }
}
