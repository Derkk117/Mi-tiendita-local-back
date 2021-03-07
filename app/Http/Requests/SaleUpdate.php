<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class SaleUpdate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge(['email' => strtolower($this->email)]);
    }

    public function rules()
    {
        return [
            'products' => 'required',
            'payment_method' => 'required',
            'card_number' => 'required',
            'card_cvc' => 'required',
        ];
    }

    public function mesagges()
    {
        return [
            'email.required' => 'El correo es un campo obligatorio',
            'email.email' => 'El correo debe que tener el siguiente formato correo@sacar.com',
            'payment_method' => 'El metodo de pago se debe de elegir',
            'card_number' => 'El numero de tarjeta se debe de ingresar',
            'card_cvc' => 'La tarjeta de CVC es un campo obligatorio',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()
        ], 422));   
    }
}