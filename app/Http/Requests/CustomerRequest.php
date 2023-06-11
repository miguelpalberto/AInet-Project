<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocenteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //TODO: usar em user?
            // 'name' => [
            //     'required',
            //     Rule::unique('users', 'name')->ignore($this->id),
            // ],
            // 'email' => [
            //     'required',
            //     'email',
            //     Rule::unique('users', 'email')->ignore($this->id),
            // ],
            // 'user_type' =>          'required',

            'nif' =>                    'min:9|max:9',
            'address' =>                'string|max:255',
            'default_payment_type' =>   'nullable|in:VISA,MC,PAYPAL',
            // 'default_payment_ref' => [
            //     'nullable',
            //     Rule::requiredIf(function () {
            //         $paymentType = $this->input('default_payment_type');
            //         return $paymentType === 'PAYPAL' || $paymentType === 'VISA' || $paymentType === 'MC';
            //     })
            // ],
            //TODO confirmar

            'password_inicial' =>       'sometimes|required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nif.min' =>  'NIF tem de ter 9 caracteres',
            'nif.max' =>  'NIF tem de ter 9 caracteres',
            'address.string' =>  'Morada tem de ser uma string',
            'default_payment_type.in' => 'O Tipo de Pagamento Predefinido tem de ser Visa, MasterCard ou Paypal',
            // 'default_payment_ref.required' => 'Se indicar Tipo de Pagamento Predefinido tem de indicar a respetiva Referência',

            'password_inicial.required' => 'A password inicial é obrigatória',
        ];
    }
}
