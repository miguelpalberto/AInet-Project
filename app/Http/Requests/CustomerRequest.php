<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('users', 'name')->ignore($this->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->id),
            ],
            'user_type' =>          'required|in:C',

            'nif' =>                    'integer|digits:9',
            'address' =>                'string|max:255',
            'default_payment_type' =>   'nullable|in:VISA,MC,PAYPAL',
            //'default_payment_ref' =>  'nullable',
            'default_payment_ref' => [
                Rule::requiredIf(function () {
                    return $this->input('default_payment_type') !== null;
                }),
            ],


            //'default_payment_ref' => 'nullable',


          
            //TODO confirmar
            //TODO foto


            'password_inicial' => 'sometimes|required'


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
            'name.required' =>  'O nome é obrigatório',
            'name.unique' =>    'O nome tem que ser único',
            'email.required' => 'O email é obrigatório',
            'email.email' =>    'O formato do email é inválido',
            'email.unique' =>   'O email tem que ser único',
            'user_type.required' => 'O tipo de utilizador é obrigatório',
            'user_type.in' => 'O tipo de utilizador tem de ser C',

            'nif.integer' =>  'NIF tem de ser um inteiro',
            'nif.digits' =>  'NIF tem de ter 9 caracteres',
            'address.string' =>  'Morada tem de ser uma string',
            'default_payment_type.in' => 'O Tipo de Pagamento Predefinido tem de ser Visa, MasterCard ou Paypal',
            'default_payment_ref.required' => 'Se indicar Tipo de Pagamento Predefinido, tem de indicar a respetiva Referência',
            //TODO foto

            'password_inicial.required' => 'A password inicial é obrigatória',

        ];
    }
}
