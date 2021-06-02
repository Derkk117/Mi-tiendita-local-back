<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;   

class DeliveryUpdate extends FormRequest
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
            //'delivered_date' => 'required',
            //'sale_id' => 'required'
        ];
    }

    public function mesagges()
    {
        return [
            'email.required' => 'El correo es un campo obligatorio',
            'email.email' => 'El correo debe que tener el siguiente formato correo@sacar.com',
            //'delivered_date' => 'La fecha de entrega se debe de ingresar',
            //'sale_id' => 'El ID de la venta es un campo obligatorio',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()
        ], 422));   
    }
}